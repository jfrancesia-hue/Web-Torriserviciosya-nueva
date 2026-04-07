<?php
file_put_contents(__DIR__ . "/test_cron.txt", "OK " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);