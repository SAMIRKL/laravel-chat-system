<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Room;
use App\Models\User;
use App\Models\Message;

use App\Events\Example;
class Chat extends Component
{

    public User $user;
    public $message;
    public Room $room;
    public array $messages;
    public $userInRoom = [];
    public function mount(Room $room): void {
        $this->room = $room;
        $this->user = auth()->user();
        $this->messages = Message::where("room_id", $this->room->id)->with(['user'])->get(['user_id', 'message'])->toArray();
        
    }
    
    public function sendMessage() {
        // dd();

        if ($this->message != '') {
            $message = Message::create([
                'user_id' => auth()->id(),
                'message' => $this->message,
                'room_id' => $this->room->id,
            ]);
            Example::dispatch(auth()->user(), $message, $this->room->id);
            $this->message= '';

        }

    }

    // #[On("echo-private:chat.room.{room.id},Example")]
    // public function renderNewMessage($data) {
    //     $this->js("");
    //     // $this->messages[] = [
    //     //     'user' => $data['user'],
    //     //     'message' => $data['message'],
    //     // ];
    // }
    #[On('echo-presence:room.{room.id},here')]
    public function renderUsers($data) {
        foreach ($data as $value) {
            $this->userInRoom[] = strtoupper($value['name']);
        }
    }
    #[On('echo-presence:room.{room.id},joining')]
    public function handleJoining($data) {
            $this->userInRoom[] = strtoupper($data['name']);
    }
    #[On('echo-presence:room.{room.id},leaving')]
    public function handleLeaving($data) {
        $s = array_filter($this->userInRoom, function ($value) use ($data) {
            return $value != strtoupper($data['name']);
        });
        $this->userInRoom = $s;
            
            
    }
    public function render()
    {
        return view('livewire.chat')->layout('layouts.app');
    }
}
