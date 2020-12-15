<?php

declare(strict_types=1);

function getRightApiLimit(int $limit): int
{
    if ($limit > 100 || $limit < 1) {
        return 10;
    }

    return $limit;
}
