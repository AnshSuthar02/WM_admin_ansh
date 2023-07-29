<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leads extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata['logged_in']['id']) {
            redirect('User_authentication/index');
        }
        error_reporting(0);
        $this->load->helper('form');
        $this->load->helper('download');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->library('session');
        $this->load->library('template');
        $this->load->model('employee');
        $this->load->model('order_model');
    }

    public function index()
    {
        $data = array();
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "Leads/index";
        $config["total_rows"] = $this->totalLeads();
        $config["per_page"] = 200;
        $config["uri_segment"] = 3;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();

        $data['title'] = 'Leads Master';

        $conditions = array();
        if ($_GET) {
            $conditions['l_status']         = $_GET['l_status'];
            $conditions['project_title']    = $_GET['project_title'];
            $conditions['mobile']           = $_GET['mobile'];
            $conditions['status']           = '0';
            $data['conditions']             = $conditions;
            $data['leads']                  = $this->get_all_leads($config["per_page"], $page, $conditions);
        } else {
            $conditions['l_status']         = '';
            $conditions['project_title']    = '';
            $conditions['mobile']           = '';
            $conditions['status']           = '0';
            $data['conditions']             = $conditions;
            $data['leads']                  = $this->get_all_leads($config["per_page"], $page, $conditions);
        }
        $data['filter']     = $this->get_all();

        $data['pages']      = $this->order_model->getPagesList();
        $data['countries']  = $this->employee->getCountries();

        $result             = $this->call_list();
        $data['call_lists'] = $result;

        $this->template->load('template', 'leads/leads_master', $data);
    }

    public function cancelLeads()
    {
        $data = array();
        $this->load->library("pagination");
        $config = array();
        $config["base_url"] = base_url() . "Leads/cancelLeads";
        $config["total_rows"] = $this->totalCancelLeads();
        $config["per_page"] = 100;
        $config["uri_segment"] = 3;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();

        $data['title'] = 'Leads Master';

        $conditions = array();
        if ($_GET) {
            $conditions['l_status']         = $_GET['l_status'];
            $conditions['project_title']    = $_GET['project_title'];
            $conditions['mobile']           = $_GET['mobile'];
            $conditions['status']           = '1';
            $data['conditions']             = $conditions;
            $data['leads']                  = $this->get_all_leads($config["per_page"], $page, $conditions);
        } else {
            $conditions['l_status']      = '';
            $conditions['project_title'] = '';
            $conditions['mobile']        = '';
            $conditions['status']        = '1';
            $data['conditions']          = $conditions;
            $data['leads']               = $this->get_all_leads($config["per_page"], $page, $conditions);
        }
        $data['filter']     = $this->get_all();

        $data['pages']      = $this->order_model->getPagesList();
        $data['countries']  = $this->employee->getCountries();

        $result             = $this->call_list();
        $data['call_lists'] = $result;

        $this->template->load('template', 'leads/cancel_leads', $data);
    }

    public function totalLeads()
    {
        $this->db->select('*');
        $this->db->from('leads');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function totalCancelLeads()
    {
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->from('leads');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function add_new_lead()
    {
        $this->form_validation->set_rules('user_mobile', 'Mobile', 'required');

        if ($this->form_validation->run() == FALSE) {
            if (isset($this->session->userdata['logged_in'])) {
                redirect('/Leads/index');
            } else {
                $this->load->view('login_form');
            }
        } else {
            $loginId = $this->session->userdata['logged_in']['id'];
            $date1   = date("Y-m-d");
            if (!empty($this->input->post('delivery_date'))) {
                $deliveryData = $this->input->post('delivery_date');
            } else {
                $deliveryData = getCurrentDate();
            }

            $data = array(
                'emp_id'      => $loginId,
                'user_name'   => $this->input->post('user_name'),
                'email'       => $this->input->post('user_email'),
                'mobile'      => $this->input->post('user_mobile'),
                'countrycode'   => $this->input->post('countrycode'),
                'project_title' => $this->input->post('project_title'),
                'pages'         => $this->input->post('pages'),
                'price'         => $this->input->post('price'),
                'delivery_time' => $this->input->post('delivery_time'),
                'web_id'        => 1,
                'deadline'      => $deliveryData,
                'create_at'     => $date1,
            );

            $last_6 = substr($data['mobile'], -6);
            $str = 'user' . $last_6;

            if (empty($data['user_name'])) {
                // $data['user_name'] = $str;
            }
            if (empty($data['email'])) {
                // $data['email'] = $str;
            }

            $voucher_no       = $this->order_model->getOrderId();
            $order_id         = 'UKS' . $voucher_no;
            $data['order_id'] = $order_id;

            $result = $this->db->insert('leads', $data);
            $insert_id = $this->db->insert_id();

            if ($result == TRUE) {
                $odrData = array();
                $odrData['lead_id']  = $insert_id;
                $odrData['order_id'] = $order_id;
                $odrData['flag']     = '1';
                $this->db->insert('orders', $odrData);

                $this->session->set_flashdata('success', 'Lead Added Successfully!');
                redirect('/Leads/index', 'refresh');
            } else {
                $this->session->set_flashdata('failed', 'Lead insertion failed!');
                redirect('/Leads/index', 'refresh');
            }
        }
    }

    public function insert($data)
    {
        $condition = "email =" . "'" . $data['email'] . "'";
        $this->db->select('*');
        $this->db->from('leads');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->insert('leads', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function get_all_leads($limit, $start, $conditions)
    {
        $login_id = $this->session->userdata['logged_in']['id'];
        $this->db->select('*, leads.id as id, countries.phonecode as phonecode');
        $this->db->from('leads');

        if (isset($conditions['l_status']) && !empty($conditions['l_status'])) {
            $this->db->where('leads.l_status', $conditions['l_status']);
        }

        if (isset($conditions['project_title']) && !empty($conditions['project_title'])) {
            $this->db->where('leads.project_title', $conditions['project_title']);
        }

        if (isset($conditions['mobile']) && !empty($conditions['mobile'])) {
            $this->db->where('leads.mobile', $conditions['mobile']);
        }

        if (!empty($conditions['status']) || $conditions['status'] == '0') {
            $this->db->where('leads.status', $conditions['status']);
        }

        $this->db->where('leads.flag', 0);
        $this->db->join('countries', 'leads.countrycode = countries.id', 'left');
        $this->db->limit($limit, $start);
        $this->db->order_by("leads.id", "desc");
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }

    public function get_all()
    {
        $login_id = $this->session->userdata['logged_in']['id'];
        $this->db->select('*, leads.id as id');
        $this->db->from('leads');
        $this->db->where('leads.flag', 0);
        $this->db->order_by("leads.id", "desc");
        $this->db->group_by("leads.mobile");
        $query = $this->db->get();
        $query->result_array();
        return $query->result_array();
    }


    
    public function convert_lead()
    {
        $login_id = $this->session->userdata['logged_in']['id'];
    
        $this->db->select('*');
        $this->db->from('leads');
        $this->db->where('id', $_POST['id']);
        $webid = $this->db->get();
        $mweb = $webid->row_array();
    
        if ($mweb['web_id'] == 1) {
            if ((isset($_POST['mobile']) && $_POST['mobile'] != 'NA')) {
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where('employees.mobile_no', $_POST['mobile']);
                $query1 = $this->db->get();
                $user_record = $query1->row_array();
            } else {
                $user_record = '';
            }
    
            $userData = array();
            if (empty($user_record)) {
                $userData['role_id']    = 2;
                $userData['password']   = md5('user@123');
                $userData['created_by'] = $_POST['emp_id'];
                if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
                    $userData['name'] = $_POST['user_name'];
                }
                if (isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] != 'NA') {
                    $userData['email']    = $_POST['email'];
                    $userData['username'] = $_POST['email'];
                } else {
                    $last_6 = substr($_POST['mobile'], -6);
                    $str = 'user' . $last_6;
                    $userData['email'] = $str;
                }
                if (isset($_POST['phonecode']) && !empty($_POST['phonecode'])) {
                    $userData['countrycode'] = $_POST['phonecode'];
                } else {
                    $userData['countrycode'] = $_POST['countrycode'];
                }
                if (isset($_POST['mobile']) && !empty($_POST['mobile'])) {
                    $userData['mobile_no'] = $_POST['mobile'];
                }
                $this->db->insert('employees', $userData);
                $insert_id = $this->db->insert_id();
            } else {
                if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
                    $userData['name'] = $_POST['user_name'];
                }
                if (isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] != 'NA') {
                    $userData['email']    = $_POST['email'];
                    $userData['username'] = $_POST['email'];
                }
                if (isset($_POST['phonecode']) && !empty($_POST['phonecode'])) {
                    $userData['countrycode'] = $_POST['phonecode'];
                }
                if (isset($_POST['countrycode']) && !empty($_POST['countrycode'])) {
                    $userData['countrycode'] = $_POST['countrycode'];
                }
    
                $this->db->set('edited_by', $login_id);
                $this->db->where('id', $user_record['id']);
                $this->db->update('employees', $userData);
                $insert_id = $user_record['id'];
            }
    
            if (!empty($insert_id)) {
                $date1   = date("Y-m-d");
                $date2   = date("Y-m-d", strtotime($this->input->post('deadline')));
                $diff    = abs(strtotime($date1) - strtotime($date2));
                $years   = floor($diff / (365 * 60 * 60 * 24));
                $months  = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days    = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    
                $orderData = array();
                $orderData['uid']            = $insert_id;
    
                if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                    $orderData['order_id'] = $_POST['order_id'];
                } else {
                    $voucher_no            = $this->order_model->getOrderId();
                    $order_id              = 'UKS' . $voucher_no;
                    $orderData['order_id'] = $order_id;
                }
    
                $orderData['order_date']     = $date1;
                $orderData['services']       = 'First Class Standard';
                $orderData['formatting']     = 'Harvard';
                $orderData['typeofpaper']    = 'Assignment';
                $orderData['typeofwritting'] = 'Post Graduate';
                $orderData['pages']          = $_POST['pages'];
                $orderData['title']          = $_POST['project_title'];
                $orderData['deadline']       = $days;
                $orderData['delivery_date']  = $_POST['deadline'];
                $orderData['delivery_time']  = $_POST['delivery_time'];
                $orderData['message']        = '';
                $orderData['actual_amount']  = $_POST['price'];
                $orderData['discount_per']   = 0;
                $orderData['amount']         = $_POST['price'];
                $orderData['paymentstatus']  = 'Pending';
                $orderData['projectstatus']  = 'Other';
                $orderData['order_type']     = 'Back-End';
                $orderData['created_by']     = $login_id;
    
                $lead_id = $_POST['id'];
                $this->db->select('*');
                $this->db->from('orders');
                $this->db->where('orders.lead_id', $lead_id);
                $query2 = $this->db->get();
                $ordDt1 = $query2->row_array();
    
                if (!empty($ordDt1)) {
                    $order_row_id = $orderData['order_id'];
                    $this->db->select('*');
                    $this->db->from('orders');
                    $this->db->where('orders.order_id', $order_row_id);
                    $query3 = $this->db->get();
                    $ordDt2 = $query3->row_array();
    
                    if (!empty($ordDt2)) {
                        $orderData['flag'] = '0';
                        $this->db->select('*');
                        $this->db->from('orders');
                        $this->db->where('lead_id', $_POST['id']);
                        $this->db->update('orders', $orderData);
    
                        $this->db->select('*');
                        $this->db->from('leads');
                        $this->db->where('id', $_POST['id']);
                        $this->db->delete('leads');
                        redirect('/Orders/index', 'refresh');
                    } else {
                        $this->session->set_flashdata('failed', 'Insertion Failed');
                        redirect('/Leads/index', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('failed', 'Insertion Failed');
                    redirect('/Leads/index', 'refresh');
                }
            } else {
                $this->session->set_flashdata('failed', 'Insertion Failed');
                redirect('/Leads/index', 'refresh');
            }
        } else {
            $login_id = $this->session->userdata['logged_in']['id'];
    
            $email = isset($_POST['email']) && $_POST['email'] != 'NA' ? $_POST['email'] : '';
            $mobile = isset($_POST['mobile']) && $_POST['mobile'] != 'NA' ? $_POST['mobile'] : '';
    
            $this->db->select('*');
            $this->db->from('employees');
            $this->db->where('employees.email', $email);
            $query = $this->db->get();
            $user_record = $query->row_array();
    
            $userData = array();
    
            if (empty($user_record)) {
                $userData['role_id'] = 2;
                $userData['password'] = md5('user@123');
                $userData['created_by'] = $_POST['emp_id'];
                if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
                    $userData['name'] = $_POST['user_name'];
                }
                if (!empty($email)) {
                    $userData['email'] = $email;
                    $userData['username'] = $email;
                } else {
                    $last_6 = substr($mobile, -6);
                    $str = 'user' . $last_6;
                    $userData['email'] = $str;
                }
                if (isset($_POST['phonecode']) && !empty($_POST['phonecode'])) {
                    $userData['countrycode'] = $_POST['phonecode'];
                } else {
                    $userData['countrycode'] = $_POST['countrycode'];
                }
                if (!empty($mobile)) {
                    $userData['mobile_no'] = $mobile;
                }
    
                $this->db->insert('employees', $userData);
                $insert_id = $this->db->insert_id();
            } else {
                if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
                    $userData['name'] = $_POST['user_name'];
                }
                if (!empty($email)) {
                    $userData['email'] = $email;
                    $userData['username'] = $email;
                }
                if (isset($_POST['phonecode']) && !empty($_POST['phonecode'])) {
                    $userData['countrycode'] = $_POST['phonecode'];
                }
                if (isset($_POST['countrycode']) && !empty($_POST['countrycode'])) {
                    $userData['countrycode'] = $_POST['countrycode'];
                }
    
                $this->db->set('edited_by', $login_id);
                $this->db->where('id', $user_record['id']);
                $this->db->update('employees', $userData);
                $insert_id = $user_record['id'];
            }
    
            if (!empty($insert_id)) {
                $date1   = date("Y-m-d");
                $date2   = date("Y-m-d", strtotime($this->input->post('deadline')));
                $diff    = abs(strtotime($date1) - strtotime($date2));
                $years   = floor($diff / (365 * 60 * 60 * 24));
                $months  = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days    = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    
                $orderData = array();
                $orderData['uid']            = $insert_id;
    
                if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
                    $orderData['order_id'] = $_POST['order_id'];
                } else {
                    $voucher_no            = $this->order_model->getOrderId();
                    $order_id              = 'UKS' . $voucher_no;
                    $orderData['order_id'] = $order_id;
                }
    
                $orderData['order_date']     = $date1;
                $orderData['services']       = 'First Class Standard';
                $orderData['formatting']     = 'Harvard';
                $orderData['typeofpaper']    = 'Assignment';
                $orderData['typeofwritting'] = 'Post Graduate';
                $orderData['pages']          = $_POST['pages'];
                $orderData['title']          = $_POST['project_title'];
                $orderData['deadline']       = $days;
                $orderData['delivery_date']  = $_POST['deadline'];
                $orderData['delivery_time']  = $_POST['delivery_time'];
                $orderData['message']        = $mweb['message'];;
                $orderData['actual_amount']  = $_POST['price'];
                $orderData['discount_per']   = 0;
                $orderData['amount']         = $_POST['price'];
                $orderData['paymentstatus']  = 'Pending';
                $orderData['projectstatus']  = 'Other';
                $orderData['order_type']     = 'Back-End';
                $orderData['created_by']     = $login_id;
    
                $lead_id = $_POST['id'];
                $this->db->select('*');
                $this->db->from('orders');
                $this->db->where('orders.lead_id', $lead_id);
                $query2 = $this->db->get();
                $ordDt1 = $query2->row_array();
    
                if (!empty($ordDt1)) {
                    $order_row_id = $orderData['order_id'];
                    $this->db->select('*');
                    $this->db->from('orders');
                    $this->db->where('orders.order_id', $order_row_id);
                    $query3 = $this->db->get();
                    $ordDt2 = $query3->row_array();
    
                    if (!empty($ordDt2)) {
                        $orderData['flag'] = '0';
                        $this->db->select('*');
                        $this->db->from('orders');
                        $this->db->where('lead_id', $_POST['id']);
                        $this->db->update('orders', $orderData);
    
                        // Check if entry exists in files_db table
                        $this->db->select('*');
                        $this->db->from('files_db');
                        $this->db->where('files_db.u_id', $_POST['emp_id']);
                        $this->db->where('files_db.detail_id', $_POST['id']);
                        $query4 = $this->db->get();
                        $fileData = $query4->row_array();
    
                        if (!empty($fileData)) {
                            // Update detail_id with the converted order's ID
                            $this->db->set('detail_id', $orderData['order_id']);
                            $this->db->where('files_db.u_id', $_POST['emp_id']);
                            $this->db->where('files_db.detail_id', $_POST['id']);
                            $this->db->update('files_db');
                        }
    
                        // Delete the corresponding lead entry
                        $this->db->where('id', $_POST['id']);
                        $this->db->delete('leads');
    
                        redirect('/Orders/index', 'refresh');
                    } else {
                        $this->session->set_flashdata('failed', 'Insertion Failed');
                        redirect('/Leads/index', 'refresh');
                    }
                } else {
                    // Insert new order
                    $this->db->insert('orders', $orderData);
                    $insert_id = $this->db->insert_id();
    
                    // Check if entry exists in files_db table
                    $this->db->select('*');
                    $this->db->from('files_db');
                    $this->db->where('files_db.u_id', $_POST['emp_id']);
                    $this->db->where('files_db.detail_id', $_POST['id']);
                    $query4 = $this->db->get();
                    $fileData = $query4->row_array();
    
                    if (!empty($fileData)) {
                        // Update detail_id with the converted order's ID
                        $this->db->set('detail_id', $insert_id);
                        $this->db->where('files_db.u_id', $_POST['emp_id']);
                        $this->db->where('files_db.detail_id', $_POST['id']);
                        $this->db->update('files_db');
                    }
    
                    // Delete the corresponding lead entry
                    $this->db->where('id', $_POST['id']);
                    $this->db->delete('leads');
    
                    redirect('/Orders/index', 'refresh');
                }
            }
        }
    }
    

    public function getUserDetails()
    {
        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where('employees.mobile_no', $_POST['mobile']);
        $query = $this->db->get();
        $user_record = $query->row_array();
        echo json_encode($user_record);
    }

    public function updateLead()
    {
        $userData = array();
        if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
            $userData['user_name'] = $_POST['user_name'];
        }
        if (isset($_POST['user_email']) && !empty($_POST['user_email'])) {
            $userData['email']    = $_POST['user_email'];
        }
        if (isset($_POST['phonecode']) && !empty($_POST['phonecode'])) {
            $userData['countrycode'] = $_POST['phonecode'];
        }
        if (isset($_POST['mobile']) && !empty($_POST['mobile'])) {
            $userData['mobile'] = $_POST['mobile'];
        }
        if (isset($_POST['project_title']) && !empty($_POST['project_title'])) {
            $userData['project_title'] = $_POST['project_title'];
        }
        if (isset($_POST['pages']) && !empty($_POST['pages'])) {
            $userData['pages'] = $_POST['pages'];
        }
        if (isset($_POST['price']) && !empty($_POST['price'])) {
            $userData['price'] = $_POST['price'];
        }
        if (isset($_POST['deadline']) && !empty($_POST['deadline'])) {
            $userData['deadline'] = $this->input->post('deadline');
        }
        if (isset($_POST['delivery_time']) && !empty($_POST['delivery_time'])) {
            $userData['delivery_time'] = $_POST['delivery_time'];
        }
        if (isset($_POST['create_at']) && !empty($_POST['create_at'])) {
            $userData['create_at'] = $_POST['create_at'];
        }
        if (isset($_POST['l_status']) && !empty($_POST['l_status'])) {
            $userData['l_status'] = $_POST['l_status'];
        }
        $this->db->set('id', $_POST['id']);
        $this->db->where('id', $_POST['id']);
        $this->db->update('leads', $userData);
        $this->session->set_flashdata('success', 'Lead Updated Successfully!');
    }

    public function updateStatus()
    {
        if (empty($status)) {
            $status = $_POST['status'];
        }
        $userData = array();
        if ($status == 1 || $status == '1') {
            $userData['status'] = '0';
        } else {
            $userData['status'] = '1';
        }
        $this->db->set('id', $_POST['id']);
        $this->db->where('id', $_POST['id']);
        $this->db->update('leads', $userData);
    }

    public function updateCheckStatus()
    {
        if (empty($status)) {
            $c_status = $_POST['c_status'];
        }
        $userData = array();
        if ($c_status == 1 || $c_status == '1') {
            $userData['c_status'] = '0';
        } else {
            $userData['c_status'] = '1';
        }
        $this->db->set('id', $_POST['id']);
        $this->db->where('id', $_POST['id']);
        $this->db->update('leads', $userData);
    }

    public function unChecked()
    {
        $userData['c_status'] = '1';
        $this->db->set('c_status', '1');
        $this->db->update('leads', $userData);
    }

    public function callstatus($id)
    {
        $data['order_id']   = $id;
        $result             = $this->call_list($id);
        $data['call_lists'] = $result;
        $this->template->load('template', 'leads/callstatus', $data);
    }

    public function callstatusadd()
    {
        $login_id = $this->session->userdata['logged_in']['id'];
        $data     = $this->input->post();
        $backurl  = $this->input->post('backurl');

        unset($data['backurl']);

        date_default_timezone_set("Europe/London");
        $data['created_on'] = date("Y-m-d h:i:s A");
        $data['created_by'] = $login_id;

        if ($data['description']) {
            $result = $this->call_insert($data);
            if ($result == TRUE) {
                // $this->session->set_flashdata('success', 'Calls Added Successfully !');
                // redirect($backurl, 'refresh');
            } else {
                // $this->session->set_flashdata('failed', 'Insertion Failed');
                // redirect($backurl, 'refresh');
            }
        } else {
            // $this->session->set_flashdata('failed', 'Insertion Failed');
            // redirect($backurl, 'refresh');
        }
    }

    public function get_call_list($order_id = '')
    {
        $user_id = $this->session->userdata['logged_in']['id'];
        if (empty($order_id)) {
            $order_id = $_POST['order_id'];
        }
        $this->db->select('calls.*, employees.name as ename');
        $this->db->from('calls');
        $this->db->join('employees', 'calls.created_by = employees.id', 'left');
        if (!empty($order_id)) {
            $this->db->where('calls.order_id', $order_id);
        }
        $call_lists = $this->db->get()->result_array();

        if (isset($call_lists) && !empty($call_lists)) {
            $html = '';
            $html .= '<ul>';
            foreach ($call_lists as $call_list) {
                if ($call_list['lead_id'] == $id) {
                    $html .= '<div class="col-md-12">';
                    if ($call_list['created_by'] == $user_id) {
                        $html .= '<li class="msg-right">';
                        $html .= "<div class='msg-left-sub'>";
                        $html .= '<div class="msg-desc">';
                        $html .= '<pre>';
                        $html .= $call_list['description'];
                        $html .= '</pre>';
                        $html .= '</div>';
                        $html .= '<small>';
                        $html .= date('d-M-y h:i:s A', strtotime($call_list['created_on']));
                        $html .= ' ';
                        $html .= '<b>';
                        $html .= $call_list['ename'];
                        $html .= '</b>';
                        $html .= '</small>';
                        $html .= '</div>';
                        $html .= '</li>';
                        $html .= '</br>';
                    } else {
                        $html .= '<li class="msg-left">';
                        $html .= "<div class='msg-left-sub'>";
                        $html .= '<div class="msg-desc">';
                        $html .= '<pre>';
                        $html .= $call_list['description'];
                        $html .= '</pre>';
                        $html .= '</div>';
                        $html .= '<small>';
                        $html .= date('d-M-y h:i:s A', strtotime($call_list['created_on']));
                        $html .= ' ';
                        $html .= '<b>';
                        $html .= $call_list['ename'];
                        $html .= '</b>';
                        $html .= '</small>';
                        $html .= '</div>';
                        $html .= '</li>';
                        $html .= '</br>';
                    }
                    $html .= "</div>";
                } else {
                    $html .= '<div class="col-md-12">';
                    $html .= "</div>";
                }
            }
            $html .= "</ul>";

            echo $html;
            die();
        }
    }

    public function call_list($id = '')
    {
        $this->db->select('calls.*, employees.name as ename');
        $this->db->from('calls');
        $this->db->join('employees', 'calls.created_by = employees.id', 'left');
        if (!empty($id)) {
            $this->db->where('calls.lead_id', $id);
        }
        $query =  $this->db->get()->result_array();
        return $query;
    }

    public function call_insert($data)
    {
        $this->db->insert('calls', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id = '')
    {
        if (empty($id)) {
            $id = $_POST['id'];
        }
        $this->db->where('id', $id);
        $this->db->delete('leads');
    }

    public function callstatusaddwrite()
    {
        $login_id = $this->session->userdata['logged_in']['id'];
        $data     = $this->input->post();
        $backurl  = $this->input->post('backurl');
      

        unset($data['backurl']);

        date_default_timezone_set("Europe/London");
        $data['created_on'] = date("Y-m-d h:i:s A");
        $data['created_by'] = $login_id;
        $data['is_read'] = 1;

        if ($data['description']) {
            $result = $this->call_insert($data);
            if ($result == TRUE) {
                // $this->session->set_flashdata('success', 'Calls Added Successfully !');
                // redirect($backurl, 'refresh');
            } else {
                // $this->session->set_flashdata('failed', 'Insertion Failed');
                // redirect($backurl, 'refresh');
            }
        } else {
            // $this->session->set_flashdata('failed', 'Insertion Failed');
            // redirect($backurl, 'refresh');
        }
    }




        public function get_call_listwriter($order_id = '')
{
    $user_id = $this->session->userdata['logged_in']['id'];
    if (empty($order_id)) {
        $order_id = $_POST['order_id'];
    }
    $this->db->select('calls.*, employees.name as ename');
    $this->db->from('calls');
    $this->db->join('employees', 'calls.created_by = employees.id', 'left');
    if (!empty($order_id)) {
        $this->db->where('calls.order_id', $order_id);
    }
    $call_lists = $this->db->get()->result_array();


    if (isset($call_lists) && !empty($call_lists)) {
        $html = '';
        $html .= '<style>';
        $html .= 'ul.no-bullets { list-style-type: none; }';
        $html .= '</style>';
        $html .= '<ul class="no-bullets">';
        foreach ($call_lists as $call_list) {
            if ($call_list['lead_id'] == $id) {
                $html .= '<div class="col-md-12">';
                if ($call_list['created_by'] == $user_id) {
                    $html .= '<li class="msg-right" style="text-align:end!important;display: flex;flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DCF8C6;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;max-width: 100%;margin: 0;white-space: pre-wrap;text-align: right;">';
                    $html .= "<div class='msg-left-sub'>";
                    $html .= '<div class="msg-desc" style="white-space: pre-wrap;">';
                    $html .= '<pre>';
                    $html .= $call_list['description'];
                    if (!empty($call_list['file'])) {
                        $html .= '<a style="text-align:end!important;display: flex;flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DCF8C6;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;max-width: 100%;margin: 0;white-space: pre-wrap;text-align: right;" href="' . $call_list['file'] . '" target="_blank">' .  $call_list['file'] . ' <i class="fas fa-download"></i></a>';
                        // If you want to display an icon instead of a link, you can use an icon library like Font Awesome:
                    }
                    $html .= '</pre>';
                    $html .= '</div>';
                    $html .= '<small style="color: #888;">';
                    $html .= date('d-M-y h:i:s A', strtotime($call_list['created_on']));
                    $html .= ' ';
                    $html .= '<b  style=" font-weight: bold;">';
                    // $html .= $call_list['ename'];
                    $html .= 'You';
                    $html .= '</b>';
                    $html .= '</small>';
                   
                    $html .= '</div>';
                    $html .= '</li>';
                    $html .= '</br>';
                    // Check if the file field is not empty and display the file
                   
                    $html .= '</br>';
                } else {
                    $html .= '<li class="msg-left" style="flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DDB3B3;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;margin: 0;white-space: pre-wrap;">';
                    $html .= "<div class='msg-left-sub'>";
                    $html .= '<div class="msg-desc">';
                    $html .= '<pre>';
                    $html .= $call_list['description'];
                    $html .= '</pre>';
                    if (!empty($call_list['file'])) {
                        $html .= '<a  style="flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DDB3B3;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;margin: 0;white-space: pre-wrap;" " href="' . $call_list['file'] . '" target="_blank">' .  $call_list['file'] . ' <i class="fas fa-download"></i></a>';
                        // If you want to display an icon instead of a link, you can use an icon library like Font Awesome:
                    }
                    $html .= '</div>';
                    $html .= '<small>';
                    $html .= date('d-M-y h:i:s A', strtotime($call_list['created_on']));
                    $html .= ' ';
                    $html .= '<b>';
                    $html .= $call_list['ename'];
                    $html .= '</b>';
                    $html .= '</small>';
                    $html .= '</div>';
                    $html .= '</li>';
                    $html .= '</br>';
                    // Check if the file field is not empty and display the file
                   
                    $html .= '</br>';
                }
                $html .= "</div>";
            } else {
                $html .= '<div class="col-md-12">';
                $html .= "</div>";
            }
        }
        $html .= "</ul>";

        echo $html;
        die();
    }
}

public function callstatusaddwritecint()
{
    $login_id = $this->session->userdata['logged_in']['id'];
    $data = $this->input->post();
    $backurl = $this->input->post('backurl');

    unset($data['backurl']);

    date_default_timezone_set("Europe/London");
    $data['created_on'] = date("Y-m-d h:i:s A");
    $data['created_by'] = $login_id;

    if ($_FILES['files']['name'] != '') {
        $output = '';
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|png'; // Change 'allowed_type' to 'allowed_types'
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

            $_FILES['file']['name'] = $_FILES["files"]["name"][$i];
            $_FILES['file']['type'] = $_FILES["files"]["type"][$i];
            $_FILES['file']['tmp_name'] = $_FILES["files"]["tmp_name"][$i];
            $_FILES['file']['error'] = $_FILES["files"]["error"][$i];
            $_FILES['file']['size'] = $_FILES["files"]["size"][$i];

            if($this->upload->do_upload('file'))
            {
                $data['file'] = $this->upload->data();
                $output = base_url().'/upload'.$data['file_name'];
            }
            // Handle file upload logic here for each file
        }
    }
    

    
    if ($data['description']) {
        $result = $this->call_insert_c($data);
        if ($result == TRUE) {
            // $this->session->set_flashdata('success', 'Calls Added Successfully !');
            // redirect($backurl, 'refresh');
        } else {
            // $this->session->set_flashdata('failed', 'Insertion Failed');
            // redirect($backurl, 'refresh');
        }
    } else {
        // $this->session->set_flashdata('failed', 'Insertion Failed');
        // redirect($backurl, 'refresh');
    }
}

    public function call_insert_c($data)
    {
        $this->db->insert('clintchat', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_call_listwriterc($id = '')
    {
        $user_id = $this->session->userdata['logged_in']['id'];
        if (empty($id)) {
            $order_id = $_POST['order_id'];
        }
        $this->db->select('clintchat.*, employees.name as ename');
        $this->db->from('clintchat');
        $this->db->join('employees', 'clintchat.created_by = employees.id', 'left');
        if (!empty($id)) {
            $this->db->where('clintchat.order_id', $order_id);
        }
        $call_lists = $this->db->get()->result_array();
    
    
        if (isset($call_lists) && !empty($call_lists)) {
            $html = '';
            $html .= '<style>';
            $html .= 'ul.no-bullets { list-style-type: none; }';
            $html .= '</style>';
            $html .= '<ul class="no-bullets">';
            foreach ($call_lists as $call_list) {
                if ($call_list['lead_id'] == $id) {
                    $html .= '<div class="col-md-12">';
                    if ($call_list['created_by'] == $user_id) {
                        $html .= '<li class="msg-right" style="text-align:end!important;display: flex;flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DCF8C6;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;max-width: 100%;margin: 0;white-space: pre-wrap;text-align: right;">';
                        $html .= "<div class='msg-left-sub'>";
                        $html .= '<div class="msg-desc" style="white-space: pre-wrap;">';
                        $html .= '<pre>';
                        $html .= $call_list['description'];
                        if (!empty($call_list['file'])) {
                            $html .= '<a style="text-align:end!important;display: flex;flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DCF8C6;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;max-width: 100%;margin: 0;white-space: pre-wrap;text-align: right;" href="' . $call_list['file'] . '" target="_blank">' .  $call_list['file'] . ' <i class="fas fa-download"></i></a>';
                            // If you want to display an icon instead of a link, you can use an icon library like Font Awesome:
                        }
                        $html .= '</pre>';
                        $html .= '</div>';
                        $html .= '<small style="color: #888;">';
                        $html .= date('d-M-y h:i:s A', strtotime($call_list['created_on']));
                        $html .= ' ';
                        $html .= '<b  style=" font-weight: bold;">';
                        // $html .= $call_list['ename'];
                        $html .= 'You';
                        $html .= '</b>';
                        $html .= '</small>';
                       
                        $html .= '</div>';
                        $html .= '</li>';
                        $html .= '</br>';
                        // Check if the file field is not empty and display the file
                       
                        $html .= '</br>';
                    } else {
                        $html .= '<li class="msg-left" style="flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DDB3B3;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;margin: 0;white-space: pre-wrap;">';
                        $html .= "<div class='msg-left-sub'>";
                        $html .= '<div class="msg-desc">';
                        $html .= '<pre>';
                        $html .= $call_list['description'];
                        $html .= '</pre>';
                        if (!empty($call_list['file'])) {
                            $html .= '<a  style="flex-direction: column;align-items: flex-end;margin: 5px 0;background-color: #DDB3B3;padding: 8px 12px;border-radius: 10px 0 10px 10px;font-size: 14px;margin: 0;white-space: pre-wrap;" " href="' . $call_list['file'] . '" target="_blank">' .  $call_list['file'] . ' <i class="fas fa-download"></i></a>';
                            // If you want to display an icon instead of a link, you can use an icon library like Font Awesome:
                        }
                        $html .= '</div>';
                        $html .= '<small>';
                        $html .= date('d-M-y h:i:s A', strtotime($call_list['created_on']));
                        $html .= ' ';
                        $html .= '<b>';
                        $html .= $call_list['ename'];
                        $html .= '</b>';
                        $html .= '</small>';
                        $html .= '</div>';
                        $html .= '</li>';
                        $html .= '</br>';
                        // Check if the file field is not empty and display the file
                       
                        $html .= '</br>';
                    }
                    $html .= "</div>";
                } else {
                    $html .= '<div class="col-md-12">';
                    $html .= "</div>";
                }
            }
            $html .= "</ul>";
    
            echo $html;
            die();
        }
    }

    public function writefile()
    {
        $login_id = $this->session->userdata['logged_in']['id'];
        $data = $this->input->post();
        $backurl = $this->input->post('u');
    
        // Unset the 'backurl' from the data array
        unset($data['backurl']);
    
        // Create a new array to store the data
        $newData = array(
            'created_on' => date("Y-m-d h:i:s A"), // Assuming you want to store the current timestamp
            'created_by' => $login_id,
            'order_id' => $this->input->post('order_id'), // Assuming 'order_id' is the correct field name
            'is_read' => 1, // Assuming 'order_id' is the correct field name
        );
    
        // Merge the $data array with the $newData array
        $data = array_merge($data, $newData);
    
        // File upload handling
        if (!empty($_FILES['file_call']['name'])) {
            $config = array(
                'upload_path' => './uploads/',
                'allowed_types' => '*',
                'max_size' => '50000',
            );
    
            // Load the upload library
            $this->load->library('upload', $config);
    
            foreach ($_FILES['file_call']['name'] as $i => $file_name) {
                $_FILES['file']['name']     = $_FILES['file_call']['name'][$i];
                $_FILES['file']['type']     = $_FILES['file_call']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['file_call']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['file_call']['error'][$i];
                $_FILES['file']['size']     = $_FILES['file_call']['size'][$i];
    
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $picture = base_url('uploads/' . $filename);
                } else {
                    $picture = '';
                }
    
                $data['file'] = $picture; // Store the filename directly without JSON encoding
    
                // Assuming you have a model to handle database operations, update the following line accordingly
                $this->db->insert('calls', $data);
    
                if ($this->db->affected_rows() > 0) {
                    // File uploaded and data inserted successfully
                    // You may perform additional actions here if needed
                } else {
                    // Error occurred while inserting data
                    // You may handle the error scenario here
                }
            }
        }
    }
   
    // After all the operations are complete, redirect back to the same URL with the data as parameters

    
    

    



    }

    


