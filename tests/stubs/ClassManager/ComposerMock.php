<?php

declare(strict_types=1);

namespace Qenary\Tests\ClassManager;

use Qenary\Implementation\ClassManager\Composer;

include_once "stubsForClasses.php";

class ComposerMock extends Composer
{
    public function execute() {}

    public function classes(): array
    {
        return [
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_class1::class,
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_class2::class,
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_interface1::class,
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_interface2::class,
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_interface3::class,
        ];
    }

    public function interfaces(): array
    {
        return [
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_interface1::class,
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_interface2::class,
            ComposerMock_f6cdbc63_c184_496a_8dbc_bb035bd6be94_interface3::class,
        ];
    }
}
