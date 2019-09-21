<?php

namespace App\Services\Payment;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class Unitpay implements PaymentInterface
{
    public $public_key = '';
    public $secret_key = '';
    public $project_id = '';
    public $currency = '';

    public function __construct()
    {
        $this->public_key = env('UNITPAY_PUBLIC_KEY');
        $this->secret_key = env('UNITPAY_SECRET_KEY');
        $this->project_id = env('UNITPAY_PROJECT_ID');
        $this->currency = env('UNITPAY_CURRENCY');
    }

    /**
     * @inheritDoc
     */
    public function getUrl(Payment $payment, $message): string
    {
        return 'https://unitpay.ru/pay/' . $this->public_key .
            '?sum=' . $payment->amount .
            '&account=' . $payment->account .
            '&desc=' . $message .
            '&signature=' . $this->getFormSignature($payment, $message);
    }

    public function getPaymentResult(Request $request): PaymentResultDto
    {
        $result = new PaymentResultDto();

        try {
            $unitPay = new \UnitPay($this->secret_key);
            $unitPay->checkHandlerRequest();

            $method = $request->input('method');
            $params = $request->input('params');

            $payment = $this->getPaymentByUid($params['account']);
            if ($payment->status === Payment::STATUS_PAY) {
                $result->payment = $payment;
                $result->message = 'Оплата прошла успешно.';
                $result->status = $result::STATE_SUCCESS;

                return $result;
            }

            $message = '';
            switch ($method) {
                case 'check':
                    $this->validateOrder($payment, $params);
                    $payment->payment_id = $params['unitpayId'];
                    $payment->status = Payment::STATUS_CHECK;
                    $message = 'Проверка прошла успешно. Мы готовы принять Вашу оплату.';
                    $status = $result::STATE_READY;
                    break;
                case 'pay':
                    $payment->status = Payment::STATUS_PAY;
                    $message = 'Оплата произведена. Большое спасибо!';
                    $status = $result::STATE_PAY;
                    break;
                case 'error':
                    $payment->status = Payment::STATUS_ERROR;
                    $message = 'Произошла ошибка.';
                    $status = $result::STATE_ERROR;
                    break;
            }
            $payment->save();
            $result->payment = $payment;
            $result->message = $unitPay->getSuccessHandlerResponse($message);
            $result->status = $status;

        } catch (Throwable $e) {
            $result->status = $result::STATE_ERROR;
            $result->message = $unitPay->getErrorHandlerResponse($e->getMessage());
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getPaymentByUid(string $uid): Payment
    {
        return Payment::where('account', $uid)->firstOrFail();
    }

    /**
     * @inheritDoc
     * @param Payment $payment
     * @param array $params
     */
    private function validateOrder(Payment $payment, array $params): void
    {
        if ($payment->status === Payment::STATUS_CHECK) {
            if ($params['orderSum'] !== $payment->amount ||
                $params['account'] !== $payment->account ||
                $params['orderCurrency'] !== $this->currency ||
                $params['projectId'] !== $this->project_id) {
                throw new Exception('Order validation Error!');
            }
        }
    }

    /**
     * Создает цифровую подпись.
     *
     * @param Payment $payment
     * @param $message
     * @return string
     */
    private function getFormSignature(Payment $payment, $message)
    {
        $hashStr = $payment->account . '{up}' .
            $message . '{up}' .
            $payment->amount . '{up}' .
            $this->secret_key;
        return hash('sha256', $hashStr);
    }
}
