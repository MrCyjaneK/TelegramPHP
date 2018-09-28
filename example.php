<?php
/**
 * Telegram Bot Example whitout WebHook.
 * It uses getUpdates Telegram's API.
 *
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 */
include 'Telegram.php';

$bot_token = '';
$telegram = new Telegram($bot_token);

// Get all the new updates and set the new correct update_id
$req = $telegram->getUpdates();
for ($i = 0; $i < $telegram->UpdateCount(); $i++) {
    // You NEED to call serveUpdate before accessing the values of message in Telegram Class
    $telegram->serveUpdate($i);
    $text = $telegram->Text();
    $chat_id = $telegram->ChatID();

    if ($text == '/start') {
        $reply = "<b>Hello!</b>";
        //if (file_exists("./$chat_id/")) {
		$reply .= "\nMenu";
		$option = [['Help']];
		$keyb = $telegram->buildKeyBoard($option);
                $content = ['chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply, 'parse_mode' => 'HTML'];
		$telegram->sendMessage($content);
		return 0;
    }
}
return 0;
