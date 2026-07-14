<?php

namespace App\Events;

use App\Models\Student;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Student $student;

    /**
     * Create a new event instance.
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('students'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'student.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->student->id,
            'student_number' => $this->student->student_number,
            'first_name' => $this->student->first_name,
            'last_name' => $this->student->last_name,
            'email' => $this->student->email,
            'course' => $this->student->course,
            'year_level' => $this->student->year_level,
        ];
    }
}