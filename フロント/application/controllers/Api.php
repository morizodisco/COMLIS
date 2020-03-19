<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {
	public function click_log_register()
	{
	    $product_id = $this->input->get('product_id');
        $ranking = $this->input->get('ranking');
        $genre_id = $this->input->get('genre_id');
        $request_uri = $this->input->get('request_uri');
        $referrer = $this->input->get('referrer');

        $values = [];
        $values['genre_id'] = $genre_id;
        $values['product_id'] = $product_id;
        $values['ranking'] = $ranking;
        $values['ip'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
        $values['ua'] = $_SERVER["HTTP_USER_AGENT"];
        $values['referrer'] = $referrer;
        $values['request_uri'] = $request_uri;
        $values['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('logs', $values);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['result' => true]));
	}

    public function access_log_register()
    {
        $where = [];
        $where['domain'] = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $genre = $this->db->where('deleted_at IS NULL', NULL, false)->where($where)->get('genres')->row_array();
        $genre_id = $genre['id'] ?? 0;

        $log_check = $this->db->where([
            'genre_id' => $genre_id,
            'ip' => $_SERVER["HTTP_X_FORWARDED_FOR"],
            'ua' => $_SERVER["HTTP_USER_AGENT"],
            'created_at >=' => date('Y-m-d H:i:s', strtotime('-1 hour'))
        ])->get('access_logs')->row_array();

        if (empty($log_check)) {
            $values = [];
            $values['genre_id'] = $genre_id;
            $values['ip'] = $_SERVER["HTTP_X_FORWARDED_FOR"];
            $values['ua'] = $_SERVER["HTTP_USER_AGENT"];
            $values['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('access_logs', $values);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['result' => true]));
    }
}
