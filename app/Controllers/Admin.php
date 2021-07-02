<?php namespace App\Controllers;

use App\Libraries\CommonTasks;
use App\Models\AnnouncementModel;
use App\Models\Downloads;
use App\Models\FeedBack;
use App\Models\JoiningInstruction;
use App\Models\Results;

class Admin extends BaseController
{
    public $joiningInstruction;
    public $Downloads;
    public $results;
    public $eventModel;
    public $announcementModel;
    public $feedbackModel;
    public $session;

    public function __construct()
    {
        $this->joiningInstruction = new JoiningInstruction();
        $this->announcementModel = new AnnouncementModel();
        $this->feedbackModel = new FeedBack();
        $this->Downloads = new Downloads();
        $this->results = new Results();

        $this->session = session();

        $this->commonTask = new CommonTasks;
        helper(['date', 'form']);
    }
    public function dashBoard()
    {

    if(!$this->session->has('loggedUser')){
     return redirect()->route('login');
        }
        $data['page'] = [
            'title' => 'Admin Dashboard',
            'heading' => 'Admin Dashboard',
        ];
        return view('admin/admin', $data);
    }
    public function announcements()
    {
        $data['page'] = [
            'title' => 'Announcements',
            'heading' => 'Announcements',
        ];

        $data['announcements'] = $this->announcementModel->getAllAnnouncements();

        return view('admin/announcements', $data);
    }
//=================Publishing new Announcement====================
    public function publishAnnouncement()
    {
        if ($this->request->getMethod() == 'post') {

            $announcement = [
                'title' => $this->request->getVar('title'),
                'date' => $this->request->getVar('date'),
                'description' => $this->request->getVar('description'),
            ];

            //echo json_encode($announcement);
            $request = $this->announcementModel->saveData($announcement);

            if ($request) {
                echo json_encode('Announcement Published');
            } else {
                echo json_encode('Something Went Wrong');
            }

        }
    }
    //=================Update existing announcement====================
    public function updateAnnouncement()
    {
        if ($this->request->getMethod() == 'post') {
            $theId = $this->request->getVar('theId');
            $announcement = [
                'title' => $this->request->getVar('title'),
                'date' => $this->request->getVar('date'),
                'description' => $this->request->getVar('description'),
            ];

            //echo json_encode($announcement);
            $request = $this->announcementModel->updateAnnouncement($theId, $announcement);

            if ($request) {
                echo json_encode('Announcement Updated');
            } else {
                echo json_encode('Something Went Wrong');
            }

        }
    }

    public function viewSingleAnnouncement()
    {
        if ($this->request->getMethod() == 'post') {
            $announcementId = $this->request->getVar('id');
            $result = $this->announcementModel->singleAnnouncement($announcementId);

            echo json_encode($result);

        }
    }
    public function deleteAnnouncement()
    {
        if ($this->request->getMethod() == 'post') {
            $announcementId = $this->request->getVar('id');
            $result = $this->announcementModel->deleteAnnouncement($announcementId);

            echo json_encode('Announcement Deleted...');

        }
    }

    public function events()
    {
        $data['page'] = [
            'title' => 'Events',
            'heading' => 'Events',
        ];
        return view('admin/events', $data);
    }
    //=================uploading joining instruction====================

    public function joining()
    {
        $data['page'] = [
            'title' => 'Joining Instruction',
        ];

        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFile('pdf-file');

            if ($file == '') {
                $joiningInstructionData = [
                    'name' => $this->request->getVar('name'),
                    'date' => $this->request->getVar('year'),
                    'file' => '',
                ];

                $request = $this->joiningInstruction->saveData($joiningInstructionData);

                if ($request) {
                    echo ('File Uploaded');
                } else {
                    echo ('Something Went Wrong');
                }
            } else {
                $joiningInstructionData = [
                    'name' => $this->request->getVar('name'),
                    'year' => $this->request->getVar('year'),
                    'file' => $this->commonTask->processDocument($file),
                ];

                $request = $this->joiningInstruction->saveData($joiningInstructionData);

                if ($request) {
                    echo ('File Uploaded');
                } else {
                    echo ('Something Went Wrong');
                }

            }

            return redirect()->back();
        }
        // $year = date('Y');
        $data['joining'] = $this->joiningInstruction->getFiles();
        return view('admin/joining', $data);
    }

    public function deleteJoiningInstruction()
    {
        if ($this->request->getMethod() == 'post') {
            $fileId = $this->request->getVar('id');
            $result = $this->joiningInstruction->deleteJoining($fileId);

            if ($result) {

                echo json_encode('File Deleted...');
            } else {
                echo json_encode('Something is wrong...');
            }

        }

    }

    public function sendFeedback()
    {
        if ($this->request->getMethod() == 'post') {
            $data = [
                'name' => $this->request->getVar('name'),
                'message' => $this->request->getVar('message'),
            ];

            $request = $this->feedbackModel->saveData($data);
            if ($request) {

                return json_encode('submitted');

            }
        }
    }

    public function viewFeedback()
    {
        $data['page'] = [
            'title' => 'Feedback',

        ];

        $data['feedbacks'] = $this->feedbackModel->getFeedBack();
        return view('admin/feedback-admin', $data);
    }

    public function deleteFeedback()
    {
        if ($this->request->getMethod() == 'post') {
            $feedbackId = $this->request->getVar('id');
            $request = $this->feedbackModel->deleteFeedback($feedbackId);
            if ($request) {

                echo json_encode('deleted');

            }

        }
    }

    //=================document uploads====================

    public function fileUpload()
    {
        $data['page'] = [
            'title' => 'Files Upload',
        ];

        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFile('pdf-file');

            if ($file == '') {
                $document = [
                    'name' => $this->request->getVar('name'),
                    'file' => '',
                ];

                $request = $this->Downloads->saveData($document);

                if ($request) {
                    echo ('File Uploaded');
                } else {
                    echo ('Something Went Wrong');
                }
            } else {
                $document = [
                    'name' => $this->request->getVar('name'),
                    'file' => $this->commonTask->processFile($file),
                ];

                $request = $this->Downloads->saveData($document);

                if ($request) {
                    echo ('File Uploaded');
                } else {
                    echo ('Something Went Wrong');
                }

            }

            return redirect()->back();
        }
        // $year = date('Y');
        $data['downloads'] = $this->Downloads->getFiles();
        return view('admin/files-upload', $data);
    }

    public function deleteUploadedFile()
    {
        if ($this->request->getMethod() == 'post') {
            $fileId = $this->request->getVar('id');
            $result = $this->Downloads->deleteFile($fileId);

            if ($result) {

                echo json_encode('File Deleted...');
            } else {
                echo json_encode('Something is wrong...');
            }

        }

    }

//=================Academic results====================

    public function publishResult()
    {
        $data['page'] = [
            'title' => 'Academic Results',
        ];

        if ($this->request->getMethod() == 'post') {
            $file = $this->request->getFile('pdf-file');

            if ($file == '') {
                $document = [
                    'name' => $this->request->getVar('name'),
                    'year' => $this->request->getVar('year'),
                    'file' => '',
                ];

                $request = $this->results->saveData($document);

                if ($request) {
                    echo ('File Uploaded');
                } else {
                    echo ('Something Went Wrong');
                }
            } else {
                $document = [
                    'name' => $this->request->getVar('name'),
                    'year' => $this->request->getVar('year'),
                    'file' => $this->commonTask->processFile($file),
                ];

                $request = $this->results->saveData($document);

                if ($request) {
                    echo ('File Uploaded');
                } else {
                    echo ('Something Went Wrong');
                }

            }

            return redirect()->back();
        }
        // $year = date('Y');
        $data['results'] = $this->results->getFiles();
        return view('admin/results-upload', $data);
    }

    public function deleteResult()
    {
        if ($this->request->getMethod() == 'post') {
            $fileId = $this->request->getVar('id');
            $result = $this->results->deleteResult($fileId);

            if ($result) {

                echo json_encode('File Deleted...');
            } else {
                echo json_encode('Something is wrong...');
            }

        }

    }

}