<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AiAgentService;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $messages = [];
    public $input = '';

    public function mount()
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => 'Hello! I am your AI Mentor. How can I help you with your learning plan today?'
        ];
    }

    public function sendMessage(AiAgentService $aiService)
    {
        if (empty(trim($this->input))) {
            return;
        }

        // Add user message
        $this->messages[] = ['role' => 'user', 'content' => $this->input];

        // Get AI Response
        // Note: In real app, this should be queued or streamed
        $response = $aiService->chat($this->input, Auth::user());

        $this->messages[] = ['role' => 'system', 'content' => $response];

        $this->input = '';
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
