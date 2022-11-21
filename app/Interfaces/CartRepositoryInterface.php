<?php

namespace App\Interfaces;

interface CartRepositoryInterface
{
    function processCartId(string $cartId = null): string;
}
