<?php

/*
 * to change this license header, choose license headers in project properties.
 * to change this template file, choose tools | templates
 * and open the template in the editor.
 */

/**
 * description of canvasconfig
 *
 * @author jens
 */
class canvasconfig extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        //laden der form helper
        $this->load->helper(array('form', 'html', 'url'));
        //laden der form_validation library sowie der session library
        //zur verwendung von sessions und form_validations
        $this->load->library(array('form_validation', 'session'));
        //laden unserer m odels (/application/models/user.php)
        //methoden des models können dann verwendet werden mit z. b. $this->user->[..];
        $this->load->model(array('user', 'mast', 'canvas', 'tools', 'condition'));
    }

    public function index() {
        if ($this->session->userdata('login_state') === true) {
            //hier könnte man nun das entsprechende view laden.
            $this->load->view('v_wb_head');
            $this->load->view('v_navigation');
            $data = array();
            $data['editcanvas'] = false;
            $selectedcanvas = $this->input->post('scanvasid');
            $ncanvastypeid = $this->input->post('ncanvastypeid');
            //hier test ob neues boot
            if ($this->input->post('newcanvas')) {
                //$data = newmast($data);
                $data['newcanvasobject'] = $this->canvas->emptycanvas();
                $data['selectedcanvas'] = null; //$this->canvas->emptycanvas();
                $data['canvastypeselect'] = $this->tools->addnullvalue($this->canvas->getcanvastypeselect(null));
                $keys = array_keys($data['canvastypeselect']);
                $data['mastselect'] = $this->tools->addnullvalue($this->mast->getmastarrayforcanvastype(array_pop($keys)));
                $data['conditionselect'] = $this->condition->getconditionselect();
                $ncanvastypeid = null;
            } else {
                // wenn nicht, dann das augewählte boot bearbeiten
                $data["selectedcanvas"] = $selectedcanvas;
                $data["selectedcanvastype"] = null;
            }

            if ($this->input->post('savenewcanvas')) {
                $newcanvas = $this->canvas->emptycanvas();
                $newcanvas["name"] = $this->input->post('canvasname');
                $newcanvas["canvastypeid"] = $ncanvastypeid;
                $newcanvas["conditionid"] = $this->input->post('sconditionid');
                $newcanvas["mastid"] = $this->input->post('smastid');
                $ncanvastypeid = null;
                if ($this->canvas->checkcanvas($newcanvas)) {
                    $this->canvas->savecanvas($newcanvas);
                } else {
                    $this->tools->alertmessage("Zuordnung des Masttyp zu Segeltyp ist nicht konfiguriert.");
                }
            }

            if ($this->input->post('choosecanvas') || $this->input->post('savecanvas') || $this->input->post('editcanvas')) {
                $ncanvastypeid = null;
                $canvasobject = $this->canvas->getcanvasforid($selectedcanvas);
                $data['canvasobject'] = $canvasobject;
                //$canvasarray = array();
                $canvasarray = $this->canvas->getcanvasarray($canvasobject['canvasid']);
                $data['canvasarrayofcanvas'] = $canvasarray;
                if ($this->input->post('editcanvas')) {
//                    echo '<br>edit boot <br>';
                    $data['editcanvas'] = true;
                    $data['canvastypeselect'] = $this->canvas->getcanvastypeselect(null);
                    $data['mastselect'] = $this->mast->getmastnameselect();
                    $data['selectedmast'] = $canvasobject['mastid'];
                }
                if ($this->input->post('savecanvas')) {
//                    echo '<br>save boot <br>';
                    $canvasobject['canvastypeid'] = $this->input->post('scanvastypeid');
                    $canvasobject['name'] = $this->input->post('canvasname');
                    $canvasobject['mastid'] = $this->input->post('smastid');
                    $this->canvas->savecanvas($canvasobject);
                }
            }

            if ($this->input->post('deletecanvas')) {
                $this->canvas->deletecanvas($selectedcanvas);
                $this->tools->alertmessage("Segel wurde gelöscht.");
            }


            if (isset($ncanvastypeid) && $ncanvastypeid != null) {
                $newcanvas = $this->canvas->emptycanvas();
                $newcanvas["name"] = $this->input->post('canvasname');
                $newcanvas["canvastypeid"] = $ncanvastypeid;
                $newcanvas["conditionid"] = $this->input->post('sconditionid');
                $newcanvas["mastid"] = $this->input->post('smastid');
                $data['mastselect'] = $this->tools->addnullvalue($this->mast->getmastarrayforcanvastype($newcanvas["canvastypeid"]));
                $data['newcanvasobject'] = $newcanvas;
                $data['canvastypeselect'] = $this->canvas->getcanvastypeselect(null);
                $data['conditionselect'] = $this->condition->getconditionselect();
                $data['selectedcanvas'] = null; //$this->canvas->emptycanvas();
            }
            $data["canvasarray"] = $this->canvas->getcanvasnameselect(null);
            $this->load->view('v_config_canvas', $data);
            $this->load->view('v_wb_footer');
        } else {
            //redirect to http://xyz.de/login.html
            redirect("login");
        }
    }

}
