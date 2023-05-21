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

    function change_preference($connect, $user_preference) {
        $query = "UPDATE userPreference SET ";

        $update_fields = [];
        if ($user_preference['user_age_from'] != -1) {
            $update_fields[] = "userAgeFrom = " . $user_preference['user_age_from'];
        }

        if ($user_preference['user_age_to'] != -1) {
            $update_fields[] = "userAgeTo = " . $user_preference['user_age_to'];
        }

        if ($user_preference['user_gender'] != -1) {
            $update_fields[] = "userGender = " . $user_preference['user_gender'];
        }
        
        $query .= implode(',', $update_fields);
        
        $query .= " WHERE userId = " . $user_preference['user_id'];
        
        $result = mysqli_query($connect, $query);
    }

    function change_profile($connect, $user_profile) {
        $query = "UPDATE userInfo SET ";

        $update_fields = [];
        $types = '';
        $values = [];
    
        if ($user_profile['user_name'] != -1) {
            $update_fields[] = "userName = ?";
            $types .= 's';
            $values[] = $user_profile['user_name'];
        }
        if ($user_profile['user_age'] != -1) {
            $update_fields[] = "userAge = ?";
            $types .= 'i';
            $values[] = $user_profile['user_age'];
        }
        if ($user_profile['user_info'] != -1) {
            $update_fields[] = "userInfo = ?";
            $types .= 's';
            $values[] = $user_profile['user_info'];
        }
        if ($user_profile['user_img'] != -1) {
            $update_fields[] = "userPhoto = ?";
            $types .= 's';
            $values[] = $user_profile['user_img'];
        }
    
        $query .= implode(',', $update_fields);
    
        $query .= " WHERE userId = ?";
    
        $stmt = mysqli_prepare($connect, $query);
    
        // добавляем тип данных для поля userId
        $types .= 'i';
        $values[] = $user_profile['user_id'];
    
        mysqli_stmt_bind_param($stmt, $types, ...$values);
        $result = mysqli_stmt_execute($stmt);
    
        if ($result) {
            $_SESSION['user_info'] = get_user_info($connect, $user_profile['user_id']);
        }
    }