<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-5-14
 * Time: 13:58
 */

namespace App\Service\Interfaces;


interface ILiveMessageService
{
    function liveMessage($data = []);
}