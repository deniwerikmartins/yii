<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

declare(strict_types=1);

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex(string $message = 'hello world'): int
    {
        echo "{$message}\n";

        return ExitCode::OK;
    }

    // ADICIONE ESTE MÉTODO:
    public function actionTestarBanco()
    {
        try {
            Yii::$app->db->open();
            echo "\n✅ Sucesso! O Yii 2 conectou ao container MySQL do Laradock e acessou o banco 'acme'!\n\n";
        } catch (\Exception $e) {
            echo "\n❌ Erro de conexão:\n";
            echo $e->getMessage() . "\n\n";
        }
        return ExitCode::OK;
    }
}
