<?php
    function get_user_id($connect, $user_login) {
        $user_id = mysqli_query($connect, "SELECT `id` FROM `user` WHERE `login` = '$user_login'");
        $user_id = mysqli_fetch_array($user_id);
        return $user_id['id'];
    }

    function set_user_config_reg($connect, $user_id, $user_name, $user_age, $user_gender, $user_photo = 'null', $user_info = 'null') {
        $stmt = mysqli_prepare($connect, "SELECT `infoId` FROM `userInfo` WHERE `userId` = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    
        if (!mysqli_stmt_num_rows($stmt)) {
            $stmt = mysqli_prepare($connect, "INSERT INTO `userInfo` (`infoId`, `userId`, `userName`, `userAge`, `userGender`, `userPhoto`, `userInfo`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "isssss", $user_id, $user_name, $user_age, $user_gender, $user_photo, $user_info);
            mysqli_stmt_execute($stmt);
        } else {
            $stmt = mysqli_prepare($connect, "UPDATE `userInfo` SET `userName`=?, `userAge`=?, `userGender`=?, `userPhoto`=?, `userInfo`=? WHERE `userId` = ?");
            mysqli_stmt_bind_param($stmt, "sssssi", $user_name, $user_age, $user_gender, $user_photo, $user_info, $user_id);
            mysqli_stmt_execute($stmt);
        }
    }

    function set_user_preference($connect, $userId, $userAgeFrom, $userAgeTo, $userGender) {
        $stmt = mysqli_prepare($connect, "SELECT `prefId` FROM `userPreference` WHERE `userId` = ?");
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    
        if (!mysqli_stmt_num_rows($stmt)) {
            $stmt = mysqli_prepare($connect, "INSERT INTO `userPreference` (`prefId`, `userId`, `userAgeFrom`, `userAgeTo`, `userGender`) VALUES (NULL, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "isss", $userId, $userAgeFrom, $userAgeTo, $userGender);
            mysqli_stmt_execute($stmt);
        } else {
            $stmt = mysqli_prepare($connect, "UPDATE `userPreference` SET `userAgeFrom`=?, `userAgeTo`=?, `userGender`=? WHERE `userId` = ?");
            mysqli_stmt_bind_param($stmt, "isss", $userAgeFrom, $userAgeTo, $userGender, $userId);
            mysqli_stmt_execute($stmt);
        }
    }

    function get_user_info($connect, $user_id) {
        $stmt = mysqli_prepare($connect, "SELECT * FROM `userInfo` WHERE `userId` = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!mysqli_num_rows($result)) {
            return [];
        } else {
            $user_info = mysqli_fetch_array($result);
            return [
                'user_name' => $user_info['userName'],
                'user_age' => $user_info['userAge'],
                'user_gender' => $user_info['userGender'],
                'user_info' => $user_info['userInfo'],
                'user_img' => '../' . $user_info['userPhoto']
            ];
        }
    }

    function get_user_preferences($connect, $user_id) {
        $stmt = mysqli_prepare($connect, "SELECT * FROM `userPreference` WHERE `userId` = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!mysqli_num_rows($result)) {
            return [];
        } else {
            $user_preferences = mysqli_fetch_array($result);
            return [
                'user_age_from' => $user_preferences['userAgeFrom'],
                'user_age_to' => $user_preferences['userAgeTo'],
                'user_gender' => $user_preferences['userGender']
            ];
        }
    }

    function load_users($connect, $user_id)
    {
        //пагинация по 10 пользователей
        $stmt = mysqli_prepare($connect, "SELECT * FROM `userInfo` WHERE `userId` NOT LIKE ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!mysqli_num_rows($result)) {
            return [];
        } else {
            $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $user_data = [];

            foreach ($users as $user) {
                $name = $user['userName'];
                $photo = '../' . $user['userPhoto'];
                $age = $user['userAge'];
                $description = $user['userInfo'];

                $user_data[] = [
                    'name' => $name,
                    'photo' => $photo,
                    'age' => $age,
                    'description' => $description
                ];
            }

            return $user_data;
        }
    }