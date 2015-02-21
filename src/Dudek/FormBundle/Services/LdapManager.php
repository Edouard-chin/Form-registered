<?php

namespace Dudek\FormBundle\Services;

class LdapManager
{
    const LDAP_TREE   = "ou=paris,ou=people,dc=42,dc=fr";
    const LDAP_HOST   = "ldaps://ldap.42.fr";

    private $uid;
    private $pwd;

    public function __construct($uid, $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function import()
    {
        list($resource, $success) = $this->bind();
        if (!$success) {
            throw new \Exception('Unable to bind to ldap. Wrong credentials?');
        }
        $justthese = ['uid', 'jpegphoto', 'cn'];
        $search = ldap_search($resource, self::LDAP_TREE, "(uid=*)", $justthese);
        $data = ldap_get_entries($resource, $search);
        ldap_unbind($resource);
        return $data;
    }

    public function bind()
    {
        $resource = ldap_connect(self::LDAP_HOST) or die('Could not connect to ldap');
        ldap_set_option($resource, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($resource, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($resource, LDAP_OPT_NETWORK_TIMEOUT, 10);
        $ldapbind = ldap_bind($resource, "uid=".$this->uid.',ou=july,ou=2013,'.self::LDAP_TREE, $this->pwd);
        return [$resource, $ldapbind];
    }
}
