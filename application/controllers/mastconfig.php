<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of mastconfig
 *
 * @author jens
 */
class mastconfig extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        //laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //laden der form_validation library sowie der session library
        //zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //laden unserer models (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model(array('user', 'boat', 'mast', 'canvas', 'tools', 'condition'));
    }

    public function index() {
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editmast'] = false;
            $nmasttypeid = $this->input->post('nmasttypeid');
            $selectedmast = $this->input->post('smastid');
            //hier test ob neues boot
            if ($this->input->post('newmast')) {
                //$data = newboat($data);
                $data['newmastobject'] = $this->mast->emptymast();
                $data['selectedmast'] = null; //$this->mast->emptymast();
                $data['masttypeselect'] = $this->mast->getmasttypeselect(null);
                $data['boatselect'] = $this->tools->addnullvalue($this->boat->getboatarrayformasttype(null));
                $data['conditionselect'] = $this->condition->getconditionselect();
                $nmasttypeid = null;
            } else {
                // wenn nicht, dann das augewählte boot bearbeiten
                $data["selectedmast"] = $selectedmast;
                $data["selectedmasttype"] = null;
            }
            if ($this->input->post('savenewmast')) {
                $newmast = $this->mast->emptymast();
                $newmast['name'] = $this->input->post('mastname');
                $newmast['masttypeid'] = $nmasttypeid;
                $newmast['conditionid'] = $this->input->post('sconditionid');
                $newmast['boatid'] = $this->input->post('sboatid');

                $nmasttypeid = null;
                $this->mast->savemast($newmast);
            }

            if ($this->input->post('choosemast') || $this->input->post('savemast') || $this->input->post('editmast')) {
                $mastobject = $this->mast->getmastforid($selectedmast);
                $data['mastobject'] = $mastobject;
                $canvasarray = $this->canvas->getcanvasarray($mastobject['mastid']);
                $data['canvasarrayofmast'] = $canvasarray;
//                print_r($canvasarray);
                $nmasttypeid = null;

                if ($this->input->post('editmast')) {
//                    echo '<br>edit boot <br>';
                    $data['editmast'] = true;
                    $data['masttypeselect'] = $this->mast->getmasttypeselect($mastobject['boattypeid']);
                    $data['boatselect'] = $this->boat->getboatnameselect();
//                    $data['selectedboat'] = $mastobject['boatid'];
                }
                if ($this->input->post('savemast')) {
//                    echo '<br>save boot <br>';
                    $mastobject['mastid'] = $this->input->post('emastid');
                    $mastobject['masttypeid'] = $this->input->post('smasttypeid');
                    $mastobject['name'] = $this->input->post('mastname');
                    $mastobject['boatid'] = $this->input->post('sboatid');
                    $mastobject['conditionid'] = $this->input->post('econditionid');

                    $this->mast->savemast($mastobject);
                }
            }
            if ($this->input->post('deletemast')) {
                $this->mast->deletemast($selectedmast);
                $this->tools->alertmessage("mast wurde gelöscht.");
            }

            if (isset($nmasttypeid) && $nmasttypeid != null) {
                $newmast = $this->mast->emptymast();
                $newmast["name"] = $this->input->post('mastname');
                $newmast["masttypeid"] = $nmasttypeid;
                $newmast["conditionid"] = $this->input->post('sconditionid');
                $newmast["boatid"] = $this->input->post('sboatid');
                $data['boatselect'] = $this->tools->addnullvalue($this->boat->getboatarrayformasttype($newmast["masttypeid"]));
                $data['newmastobject'] = $newmast;
                $data['masttypeselect'] = $this->mast->getmasttypeselect(null);
                $data['conditionselect'] = $this->condition->getconditionselect();
                $data['selectedmast'] = null; //$this->canvas->emptycanvas();
            }
            $data["mastarray"] = $this->mast->getmastnameselect(null);
            $this->load->view('v_config_mast', $data);
            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

    function newboat($data) {
        return $data;
    }

}
