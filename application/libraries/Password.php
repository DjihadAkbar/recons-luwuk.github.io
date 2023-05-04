<?php
class Password
{
    public function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function verify($password, $hash)
    {
        if (password_verify($password, $hash)) {
            return true;
        }
        return false;
    }
}