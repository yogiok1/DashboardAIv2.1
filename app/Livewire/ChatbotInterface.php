<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProposalGroup;

class ChatbotInterface extends Component
{
    public $messages = [];
    public $userInput = '';
    public $selectedGroups = [];
    public $showGroupSelector = false;
    public $proposalGroups = [];
    public $isLoading = false;
    public $streamingMessage = '';
    public $selectAll = false;

    public function mount()
    {
        // Load proposal groups from database
        $this->proposalGroups = ProposalGroup::select('id', 'group_name', 'group_code', 'scheme')
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    public function toggleGroupSelector()
    {
        $this->showGroupSelector = !$this->showGroupSelector;
        \Log::info('toggleGroupSelector called', ['showGroupSelector' => $this->showGroupSelector]);
    }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
        
        if ($this->selectAll) {
            // Select all groups
            $this->selectedGroups = array_column($this->proposalGroups, 'id');
        } else {
            // Deselect all
            $this->selectedGroups = [];
        }
    }

    public function updatedSelectedGroups()
    {
        // Update selectAll state when individual checkboxes change
        $this->selectAll = count($this->selectedGroups) === count($this->proposalGroups);
    }

    public function removeGroup($groupId)
    {
        $this->selectedGroups = array_values(array_diff($this->selectedGroups, [$groupId]));
        $this->selectAll = false;
    }

    public function toggleGroup($groupId)
    {
        if (in_array($groupId, $this->selectedGroups)) {
            // Remove from selection
            $this->selectedGroups = array_values(array_diff($this->selectedGroups, [$groupId]));
        } else {
            // Add to selection
            $this->selectedGroups[] = $groupId;
        }
        
        // Update selectAll state
        $this->selectAll = count($this->selectedGroups) === count($this->proposalGroups);
    }

    #[On('sendMessage')]
    public function handleSendMessage()
    {
        $this->sendMessage();
    }

    public function sendMessage()
    {
        // Validate input
        if (empty(trim($this->userInput))) {
            return;
        }

        // Validate group selection
        if (empty($this->selectedGroups)) {
            $this->dispatch('show-error', message: 'Silakan pilih minimal satu grup proposal terlebih dahulu!');
            return;
        }

        // Add user message to chat
        $this->messages[] = [
            'role' => 'user',
            'content' => $this->userInput,
            'timestamp' => now()->format('H:i')
        ];

        $message = $this->userInput;
        $this->userInput = '';
        $this->isLoading = true;
        $this->streamingMessage = '';

        // Dispatch event to start streaming
        $this->dispatch('start-streaming', $message, $this->selectedGroups, $this->getConversationHistory());
    }

    #[On('streaming-complete')]
    public function handleStreamingComplete($content)
    {
        // Add assistant message
        $this->messages[] = [
            'role' => 'assistant',
            'content' => $content,
            'timestamp' => now()->format('H:i')
        ];

        $this->isLoading = false;
        $this->streamingMessage = '';
    }

    #[On('streaming-error')]
    public function handleStreamingError($error)
    {
        $this->messages[] = [
            'role' => 'assistant',
            'content' => "Maaf, terjadi kesalahan: " . $error,
            'timestamp' => now()->format('H:i'),
            'error' => true
        ];

        $this->isLoading = false;
        $this->streamingMessage = '';
    }

    private function getConversationHistory()
    {
        // Get last 10 messages for context (exclude system messages)
        $history = [];
        $recentMessages = array_slice($this->messages, -10);
        
        foreach ($recentMessages as $msg) {
            if ($msg['role'] !== 'system') {
                $history[] = [
                    'role' => $msg['role'],
                    'content' => $msg['content']
                ];
            }
        }
        
        return $history;
    }

    public function clearChat()
    {
        $this->messages = [];
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Chat telah dihapus. Silakan mulai percakapan baru!',
            'timestamp' => now()->format('H:i')
        ];
    }

    public function render()
    {
        return view('livewire.chatbot-interface');
    }
}
