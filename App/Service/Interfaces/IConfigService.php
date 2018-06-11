<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-16
 * Time: 17:35
 */

namespace App\Service\Interfaces;

interface IConfigService
{
    function getOperationStatement();

    function getOperationStatementHtml(): ?string;
}