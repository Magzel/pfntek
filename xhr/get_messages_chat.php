<?php 
if ($f == 'get_messages_chat') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $data     = array(
            'status' => 200,
            'html' => ''
        );
        $data['message'] = $wo['lang']['no_more_message_to_show'];

        $messages_chat = Wo_GetMessagesUsers($wo['user']['user_id'], '', 5);
        //$page_messages = Wo_GetPageChatList($wo['user']['user_id'], 5);
        $groups_messages_chat = Wo_GetGroupsListAPP(array('limit' => 5));
        $array_chat = array();
        if (!empty($messages_chat)) {
            foreach ($messages_chat as $key => $value) {
                $array_chat[] = $value;
            }
        }
        if (!empty($groups_messages_chat)) {
            foreach ($groups_messages_chat as $key => $value) {
                $array_chat[] = $value;
            }
        }

        array_multisort( array_column($array_chat, "chat_time"), SORT_DESC, $array_chat );
        if (!empty($array_chat)) {
            $array_chat_count = 0;
            foreach ($array_chat as $key => $value) {
                if ($array_chat_count < 4) {
                    if (!empty($value['group_id']) && !empty($value['last_message'])) {
                        $wo['group'] = $value;
                        $data['html'] .= Wo_LoadPage('header/group_messages');
                    }
                    elseif (!empty($value['message']['page_id']) && $value['message']['page_id'] > 0) {
                        $wo['page_message_chat'] = array();
                        $message_chat = Wo_GetPageMessages(array(
                                                'page_id' => $value['message']['page_id'],
                                                'from_id' => $value['message']['user_id'],
                                                'to_id'   => $value['message']['conversation_user_id'],
                                                'limit' => 1,
                                                'limit_type' => 1
                                            ));
                        $wo['page_message_chat']['message'] = $message_chat[0];
                        $data['html'] .= Wo_LoadPage('chat/page-messages-list');
                    }
                    elseif(!empty($value['message']['user_id']) && $value['message']['user_id'] > 0){
                        $message_chat = Wo_GetMessagesHeader(array('user_id' => $value['user_id']), 'user');
                        if (!empty($message_chat['messageUser'])) {
                            $wo['message'] = $value;     
                            $data['html'] .= Wo_LoadPage('chat/messages-chat');
                        }
                    }
                    $array_chat_count = $array_chat_count + 1;
                }
            }
        }
        else {
            $data['message'] = $wo['lang']['no_more_message_to_show'];
        }

        $data['messages_url']  = Wo_SeoLink('index.php?link1=messages');
        $data['messages_text'] = $wo['lang']['see_all'];
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
