<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 22.01.16
 * Time: 18:52
 */

namespace common\rbac;

use yii\rbac\Rule;
use Yii;
use yii\web\ServerErrorHttpException;

class notAdminRule extends Rule  {
    public $name = 'notAdminRule';

    public function execute($user, $item, $params)
    {
        $auth = Yii::$app->authManager;

        if (isset($params['object'])) {
            $author_id = $params['object']->author_id;
            $userRoles = $auth->getRolesByUser($author_id);
            return isset($userRoles['admin']) ? false : true;
        }
        Yii::$app->session->setFlash('error', 'Missing object to confirm access');
        return false;
    }

}