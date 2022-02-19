<?php

namespace App\Models;

use App\Models\Model;

class Viewer extends Model
{

    private $ip_address;
    private $user_agent;
    private $page_url;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function init()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $this->ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $this->ip_address = $_SERVER['REMOTE_ADDR'];
        }

        $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $this->page_url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    }

    public function start()
    {   
        if (count($this->get()) <= 0) {
            return $this->save();
        }

        return $this->update();
    }

    public function save()
    {
        $sql = sprintf('INSERT INTO %s (ip_address, user_agent, page_url, views_count) VALUES (:ip_address, :user_agent, :page_url, :views_count)', 'viewers');

        return $this->create($sql, [
            'ip_address' => ip2long($this->ip_address),
            'user_agent' => $this->user_agent,
            'page_url' => $this->page_url,
            'views_count' => 1
        ]);
        
    }

    public function update()
    {
        $sql = sprintf('UPDATE %s SET views_count=views_count+1 WHERE ip_address=:ip_address AND user_agent = :user_agent AND page_url = :page_url', 'viewers');

        return $this->create($sql, [
            'ip_address' => ip2long($this->ip_address),
            'user_agent' => $this->user_agent,
            'page_url' => $this->page_url,
        ]);
        
    }

    public function get()
    {
        $sql = sprintf('SELECT * FROM %s WHERE ip_address = :ip_address AND user_agent = :user_agent AND page_url = :page_url', 'viewers');
       
        return $this->exists($sql, [
            'ip_address' => ip2long($this->ip_address),
            'user_agent' => $this->user_agent,
            'page_url' => $this->page_url
        ]);
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}