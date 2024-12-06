<?php

class applicationData
{
    protected $dbHandle, $dbInstance;
    protected $id, $jobPost, $applicant;

    public function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->jobPost = $dbRow['jobPost'];
        $this->applicant = $dbRow['applicant'];
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getJobPost()
    {
        return $this->jobPost;
    }
    public function getApplicant()
    {
        return $this->applicant;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setJobPost($jobPost)
    {
        $this->jobPost = $jobPost;
    }
    public function setApplicant($applicant)
    {
        $this->applicant = $applicant;
    }

}