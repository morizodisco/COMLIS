<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

//全ページ共通
class MY_Controller extends CI_Controller
{
    protected $_view_prefix = '';
    protected $_systems = [];
    protected $s3_credentials = [
        'key' => 'AKIATI6K7MLWMY7YZLOX',
        'secret' => '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',
    ];
    protected $bucket;
    protected $s3;

    //    ↓ __constructは定義しなくても毎回実行される様にする処理
    public function __construct()
    {
//        ↓ parentを書かないと継承されてる親のCI_Controllerの処理を上書きしてしまうので大事！！
        parent::__construct();

        if (empty($this->systems)) $this->systems = array_column($this->db->order_by('id asc')->get('systems')->result_array(), 'system_value', 'system_key');

        if (empty($this->bucket)) $this->bucket = $this->systems['s3-bucket'] ?? NULL;

        if( $this->agent->is_mobile()){
            $this->_view_prefix = 'sp_';
        } else {
            $this->_view_prefix = 'sp_'; // 今はPCでもSPサイトを表示する
        }

        if (is_null($this->s3)) {
            $this->s3 = new S3Client([
                'credentials' => $this->s3_credentials,
                'region'  => 'ap-northeast-1',
                'version' => 'latest',
            ]);
        }
    }

    /**
     * header、footerを付けてview表示
     *
     * @param	array
     * @param	array
     * @return	void
     * */

    protected function show_view($view_list, $data = NULL)
    {
        $data['sp'] = $this->_view_prefix;

        $where = [];
        $where['domain'] = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $data['options'] = $genre = $this->db->where('deleted_at IS NULL', NULL, false)->where($where)->get('genres')->row_array();
        $media_id = $genre['media_id'] ?? 0;
        $genre_id = $genre['id'] ?? 0;

        $data['media'] = $this->db->where('id', $media_id)->get('media')->row_array();

        $data['genres'] = $this->db->where('deleted_at IS NULL', NULL, false)->where(['media_id' => $media_id, 'status_flag' => 1])->order_by('id asc')->get('genres')->result_array();

        $data['image_url'] = function ($image_path) {
            $s3host = $this->systems['s3-host'] ?? NULL;
            return '//'.$s3host.'/'.$image_path;
        };

        $data['view_count'] = count($this->db->where(['genre_id' => $genre_id, 'created_at >=' => date('Y-m-d H:i:s', strtotime('-1 hour'))])->get('access_logs')->result_array()) + 20;

        $data['genStar'] = function ($assessment) {
            switch ($assessment) {
                case 1 :
                    return '★<span>★</span><span>★</span><span>★</span><span>★</span>';
                case 2 :
                    return '★★<span>★</span><span>★</span><span>★</span>';
                case 3 :
                    return '★★★<span>★</span><span>★</span>';
                case 4 :
                    return '★★★★<span>★</span>';
                case 5 :
                default :
                    return '★★★★★';
            }
        };

        $data['genStarFloat'] = function ($assessment) {
            if ($assessment < 0.5) return '<span class="none"></span><span class="none"></span><span class="none"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 1) return '<span class="half"></span><span class="none"></span><span class="none"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 1.5) return '<span class="hull"></span><span class="none"></span><span class="none"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 2) return '<span class="hull"></span><span class="half"></span><span class="none"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 2.5) return '<span class="hull"></span><span class="hull"></span><span class="none"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 3) return '<span class="hull"></span><span class="hull"></span><span class="half"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 3.5) return '<span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="none"></span><span class="none"></span>';
            elseif ($assessment < 4) return '<span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="half"></span><span class="none"></span>';
            elseif ($assessment < 4.5) return '<span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="none"></span>';
            elseif ($assessment < 5) return '<span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="half"></span>';
            else return '<span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="hull"></span><span class="hull"></span>';
        };

        $this->load->view('include/head', $data);
        $this->load->view('include/menu', $data);

        foreach ($view_list as $view){
            $this->load->view($view, $data);
        }
        $this->load->view('include/footer', $data);
    }
}

