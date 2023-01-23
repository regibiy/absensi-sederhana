<?php
class Users
{
    private $employeeid;
    private $fullname;
    private $role;
    private $password;

    function set_login_data($employeeid, $password)
    {
        $this->employeeid = $employeeid;
        $this->password = $password;
    }

    function get_employee_id()
    {
        return $this->employeeid;
    }

    function get_password()
    {
        return $this->password;
    }

    function set_profile_data($employeeid, $fullname, $role, $password)
    {
        $this->employeeid = $employeeid;
        $this->fullname = $fullname;
        $this->role = $role;
        $this->password = $password;
    }

    function set_role($role)
    {
        $this->role = $role;
    }

    function get_fullname()
    {
        return $this->fullname;
    }

    function get_role()
    {
        return $this->role;
    }
}
