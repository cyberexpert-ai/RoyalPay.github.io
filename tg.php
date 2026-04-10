<?php

// Replace with your bot token and webhook URL
$botToken = 'YOURTGBOT';
$webhookUrl = 'https://khilaadixpro.shop/corefilesinstance/telegram-events/bot.php';

$telegramApiUrl = "https://api.telegram.org/bot{$botToken}/setWebhook?url={$webhookUrl}";

$response = file_get_contents($telegramApiUrl);
$result = json_decode($response, true);

if ($result && $result['ok']) {
    echo "Webhook URL set successfully!";
} else {
    echo "Failed to set webhook URL: " . $result['description'];
}

// Get the file name of the current script
$currentFile = __FILE__;

// Unlink (delete) the current file
unlink($currentFile);

?>
