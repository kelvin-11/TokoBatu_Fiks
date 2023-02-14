<?php
namespace app\components;

use yii\filters\auth\AuthMethod;

class CustomAuth extends AuthMethod
{
    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {
        $response = SSOToken::checkToken();
        if ($response['success'] == 0) {
            return;
        }

        return $response;
    }

    public static function auth($id)
    {
        return $id;
    }
}