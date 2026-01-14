<div class="flex flex-col h-screen" wire:key="chatbot-main">
    @if(count($messages) == 0)
        <!-- Large Centered Header - Initial State -->
        <div class="flex items-center justify-center flex-1">
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 shadow-lg">
                        <i class="text-4xl text-white fas fa-robot"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold">
                    <span class="text-blue-900 dark:text-blue-300">Asisten Riset Proposal</span>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 animate-gradient bg-[length:200%_auto]"> AI</span>
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">(Beta)</p>
                
                @if(count($selectedGroups) > 0)
                    <div class="flex items-center mt-6 px-4 py-2 bg-green-50 border border-green-200 rounded-2xl">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></div>
                        <p class="text-sm text-green-700">
                            Connected - {{ count($selectedGroups) }} grup proposal dipilih
                        </p>
                    </div>
                @else
                    <div class="flex items-center mt-6 px-4 py-2 bg-pink-50 border border-pink-200 rounded-2xl">
                        <div class="w-2 h-2 bg-orange-500 rounded-full mr-2"></div>
                        <p class="text-sm text-red-600">
                            Belum terhubung - Pilih grup proposal untuk memulai
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <!-- Compact Header - Top Left (After chatting) -->
        <div class="flex items-center justify-between p-4 flex-shrink-0">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600">
                    <i class="text-lg text-white fas fa-robot"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                        Asisten Riset Proposal AI
                    </h2>
                    @if(count($selectedGroups) > 0)
                        <p class="text-xs text-green-600 dark:text-green-400">
                            <i class="fas fa-circle text-[6px] mr-1"></i>Connected - {{ count($selectedGroups) }} grup dipilih
                        </p>
                    @else
                        <p class="text-xs text-orange-600 dark:text-orange-400">
                            <i class="fas fa-circle text-[6px] mr-1"></i>Belum terhubung
                        </p>
                    @endif
                </div>
            </div>
            
            <!-- Clear Chat Button -->
            <button 
                wire:click="clearChat"
                wire:confirm="Yakin ingin menghapus semua chat?"
                class="p-2 text-gray-600 transition-colors rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                title="Hapus Chat">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    @endif

    <!-- Messages Container -->
    <div class="flex-1 px-4 pb-4 space-y-4 overflow-y-auto" id="messages-container">
        @foreach($messages as $index => $message)
        <div class="flex {{ $message['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
            <div class="flex items-start space-x-2 max-w-3xl {{ $message['role'] === 'user' ? 'flex-row-reverse space-x-reverse' : '' }}">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    @if($message['role'] === 'user')
                    <div class="flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full">
                        <i class="text-sm text-white fas fa-user"></i>
                    </div>
                    @else
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-blue-500">
                        <i class="text-sm text-white fas fa-robot"></i>
                    </div>
                    @endif
                </div>

                <!-- Message Content -->
                <div class="flex flex-col {{ $message['role'] === 'user' ? 'items-end' : 'items-start' }}">
                    <div class="px-4 py-2 rounded-lg {{ $message['role'] === 'user' ? 'bg-blue-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white' }} {{ isset($message['error']) ? 'bg-red-100 dark:bg-red-900 text-red-900 dark:text-red-100' : '' }}">
                        <p class="text-sm whitespace-pre-wrap">{{ $message['content'] }}</p>
                    </div>
                    <span class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $message['timestamp'] }}</span>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Streaming Message (while loading) -->
        @if($isLoading)
        <div class="flex justify-start">
            <div class="flex items-start space-x-2 max-w-3xl">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-blue-500">
                        <i class="text-sm text-white fas fa-robot"></i>
                    </div>
                </div>
                <div class="flex flex-col items-start">
                    <div class="px-4 py-2 bg-white rounded-lg dark:bg-gray-800">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                        <p class="mt-2 text-sm text-gray-900 whitespace-pre-wrap dark:text-white" id="streaming-content"></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Input Area - Fixed at Bottom -->
    <div class="sticky bottom-0 p-4">
        <div class="max-w-4xl mx-auto">
            <!-- Main Input Row -->
            <div class="flex items-center gap-2 p-3 bg-white dark:bg-gray-800 rounded-3xl shadow-md border border-gray-200 dark:border-gray-700">
                <!-- Group Selector Button - PURE LIVEWIRE -->
                <div class="relative">
                    <button 
                        type="button"
                        wire:click="$toggle('showGroupSelector')"
                        class="p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 relative"
                        title="Pilih Grup Proposal">
                        <i class="fas fa-folder text-lg"></i>
                        @if(count($selectedGroups) > 0)
                            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-xs font-bold">
                                {{ count($selectedGroups) }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Menu - PURE LIVEWIRE -->
                    @if($showGroupSelector)
                    <div 
                        wire:click.outside="$set('showGroupSelector', false)"
                        class="absolute bottom-full left-0 mb-2 w-80 bg-white rounded-xl shadow-xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700 z-50">
                        <!-- Header -->
                        <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                            <h4 class="font-semibold text-gray-900 dark:text-white">
                                Pilih Grup ({{ count($proposalGroups) }})
                            </h4>
                            <button 
                                wire:click="$set('showGroupSelector', false)" 
                                type="button" 
                                class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Select All -->
                        <div class="p-3 border-b dark:border-gray-700">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectAll"
                                    class="w-4 h-4 text-blue-600 rounded">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Semua</span>
                            </label>
                        </div>

                        <!-- Groups List -->
                        <div class="overflow-y-auto max-h-64 p-2">
                            @forelse($proposalGroups as $group)
                            <label wire:key="group-{{ $group['id'] }}" class="flex items-center p-2 space-x-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectedGroups"
                                    value="{{ $group['id'] }}"
                                    class="w-4 h-4 text-blue-600 rounded">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $group['group_name'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $group['group_code'] }}</p>
                                </div>
                            </label>
                            @empty
                            <p class="text-sm text-gray-500 text-center py-4">Tidak ada grup</p>
                            @endforelse
                        </div>

                        <!-- Footer -->
                        <div class="p-3 border-t dark:border-gray-700 flex gap-2">
                            <button 
                                wire:click="$set('showGroupSelector', false)" 
                                type="button" 
                                class="flex-1 px-3 py-1.5 text-sm text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300">
                                Tutup
                            </button>
                            <button 
                                wire:click="$set('showGroupSelector', false)" 
                                type="button" 
                                class="flex-1 px-3 py-1.5 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                Terapkan
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Input Field - LIVEWIRE ONLY -->
                <input 
                    type="text" 
                    wire:model.live="userInput"
                    wire:keydown.enter.prevent="sendMessage"
                    placeholder="Tanyakan sesuatu tentang proposal penelitian..."
                    class="flex-1 px-4 py-2 bg-transparent border-0 focus:ring-0 focus:outline-none text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                    id="chat-input">
                
                <!-- Action Buttons -->
                <div class="flex items-center gap-1">
                    <!-- Voice Input -->
                    <button 
                        type="button"
                        id="voice-button"
                        class="p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 transition-colors rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                        title="Input Suara">
                        <i id="voice-icon" class="fas fa-microphone text-lg"></i>
                    </button>
                    
                    <!-- Send Button - LIVEWIRE ONLY -->
                    <button 
                        type="button"
                        wire:click.prevent="sendMessage"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        class="p-2 text-white bg-blue-500 rounded-full hover:bg-blue-600 transition-colors"
                        title="Kirim"
                        id="send-button">
                        <span wire:loading.remove wire:target="sendMessage">
                            <i class="fas fa-paper-plane text-lg px-1"></i>
                        </span>
                        <span wire:loading wire:target="sendMessage">
                            <i class="fas fa-spinner fa-spin text-lg px-1"></i>
                        </span>
                    </button>
                </div>
            </div>
        
            <!-- Disclaimer Text -->
            <p class="text-xs text-center text-gray-500 dark:text-gray-400 mt-2">
                AI dapat membuat kesalahan. Pertimbangkan untuk memeriksa informasi penting.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Add gradient animation CSS
const style = document.createElement('style');
style.textContent = `
@keyframes gradient {
    0% { background-position: 0% center; }
    50% { background-position: 100% center; }
    100% { background-position: 0% center; }
}
.animate-gradient {
    animation: gradient 3s ease infinite;
}
`;
document.head.appendChild(style);

// Auto scroll to bottom when messages change
document.addEventListener('livewire:init', () => {
    Livewire.hook('message.processed', (message, component) => {
        const container = document.getElementById('messages-container');
        if (container) {
            setTimeout(() => {
                container.scrollTop = container.scrollHeight;
            }, 100);
        }
    });
});

// Voice to Text via Web Speech API (browser-side)
(() => {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const micBtn = document.getElementById('voice-button');
    const micIcon = document.getElementById('voice-icon');
    const inputEl = document.getElementById('chat-input');
    let recognition = null;
    let isRecording = false;
    let fullTranscript = '';

    if (!micBtn) return;

    if (!SpeechRecognition) {
        micBtn.title = 'Browser belum mendukung input suara';
        micBtn.classList.add('opacity-50', 'cursor-not-allowed');
        micBtn.addEventListener('click', () => {
            alert('Browser Anda belum mendukung voice to text. Coba Google Chrome.');
        });
        return;
    }

    function startRecording() {
        if (isRecording) return;
        
        try {
            recognition = new SpeechRecognition();
            recognition.lang = 'id-ID';
            recognition.interimResults = true;
            recognition.continuous = true;
            recognition.maxAlternatives = 1;

            recognition.onstart = () => {
                isRecording = true;
                fullTranscript = inputEl.value || '';
                
                micIcon.classList.remove('fa-microphone');
                micIcon.classList.add('fa-stop', 'text-red-600');
                micBtn.classList.add('bg-red-100', 'dark:bg-red-900');
                micBtn.title = 'Klik untuk berhenti';
                console.log('Recording started');
            };

            recognition.onresult = (event) => {
                let interimTranscript = '';
                
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) {
                        fullTranscript += transcript + ' ';
                    } else {
                        interimTranscript = transcript;
                    }
                }
                
                // Show in input immediately
                inputEl.value = (fullTranscript + interimTranscript).trim();
                inputEl.dispatchEvent(new Event('input', { bubbles: true }));
            };

            recognition.onerror = (event) => {
                console.error('Speech error:', event.error);
                // Ignore no-speech errors, keep recording
                if (event.error === 'aborted' || event.error === 'network') {
                    stopRecording();
                }
            };

            recognition.onend = () => {
                console.log('Recognition ended, isRecording:', isRecording);
                // Auto-restart ONLY if user hasn't manually stopped
                if (isRecording && recognition) {
                    console.log('Auto-restarting...');
                    setTimeout(() => {
                        if (isRecording && recognition) {
                            try {
                                recognition.start();
                            } catch (err) {
                                console.error('Restart failed:', err);
                            }
                        }
                    }, 100);
                }
            };

            recognition.start();
        } catch (err) {
            console.error('Failed to start:', err);
        }
    }

    function stopRecording() {
        if (!isRecording) return;
        
        console.log('Stopping recording manually');
        isRecording = false;
        
        if (recognition) {
            try {
                recognition.stop();
            } catch (err) {
                console.error('Stop failed:', err);
            }
        }
        
        // Update UI immediately
        micIcon.classList.remove('fa-stop', 'text-red-600');
        micIcon.classList.add('fa-microphone');
        micBtn.classList.remove('bg-red-100', 'dark:bg-red-900');
        micBtn.title = 'Input Suara';
        
        // Destroy recognition instance to prevent restart
        setTimeout(() => {
            recognition = null;
        }, 200);
    }

    micBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (isRecording) {
            stopRecording();
        } else {
            startRecording();
        }
    });
})();

// Streaming function
async function startStreaming(data) {
    const streamingElement = document.getElementById('streaming-content');
    let streamingContent = '';
    
    try {
        const response = await fetch('http://localhost:8000/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                message: data.message,
                proposal_group_ids: data.groups,
                conversation_history: data.history || []
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const reader = response.body.getReader();
        const decoder = new TextDecoder();

        while (true) {
            const { done, value } = await reader.read();
            
            if (done) break;
            
            const chunk = decoder.decode(value);
            const lines = chunk.split('\n');
            
            for (const line of lines) {
                if (line.startsWith('data: ')) {
                    const data = line.slice(6);
                    
                    if (data === '[DONE]') {
                        continue;
                    }
                    
                    try {
                        const parsed = JSON.parse(data);
                        
                        if (parsed.error) {
                            Livewire.dispatch('streaming-error', { error: parsed.error });
                            return;
                        }
                        
                        if (parsed.choices && parsed.choices[0]?.delta?.content) {
                            streamingContent += parsed.choices[0].delta.content;
                            if (streamingElement) {
                                streamingElement.textContent = streamingContent;
                            }
                        }
                    } catch (e) {
                        // Ignore parse errors for incomplete chunks
                    }
                }
            }
        }

        // Streaming complete
        Livewire.dispatch('streaming-complete', { content: streamingContent });
        
    } catch (error) {
        console.error('Streaming error:', error);
        Livewire.dispatch('streaming-error', { error: error.message });
    }
}
</script>
@endpush