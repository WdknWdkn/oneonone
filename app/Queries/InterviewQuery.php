<?php

namespace App\Queries;

use Illuminate\Http\Request;
use App\Models\Interview;

class InterviewQuery
{
    protected $query;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Interview::query();
    }

    public function apply()
    {
        $interviewer_id = $this->request->interviewer_id;
        if ($interviewer_id) {
            $this->query->where('interviewer_id', $interviewer_id);
        }

        $interviewee_id = $this->request->interviewee_id;
        if ($interviewee_id) {
            $this->query->where('interviewee_id', $interviewee_id);
        }

        if ($date_from = $this->request->date_from) {
            $this->query->whereDate('interview_date', '>=', $date_from);
        }

        if ($date_to = $this->request->date_to) {
            $this->query->whereDate('interview_date', '<=', $date_to);
        }

        return $this->query->get();
    }
}
