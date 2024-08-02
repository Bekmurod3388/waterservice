home.blade.php@extends('mobile.agent.layouts.app')

@section('title', 'Home - RGD')

@section('content')
    <div class="orders">
        <div class="orders_start">
            <h1 style="text-align: center; padding: 20px 0 10px 0">Mijozlar</h1>
            <p style="font-size: 12px">
                Bugun sizga xizmat ko'rsatish uchun biriktirilgan mijozlar ro'yhati
            </p>

            @foreach($tasks as $task)
                <div class="order open-popup" >
                    <div class="order_content" style="width: 80%;" id="{{ $task->id }} fullname="{{ $task->client->name }}" onclick="openPopup({{$task}})">
                        <h5 style="margin-bottom: 15px">{{ $task->client->name }}</h5>
                        <p>Tel: {{ $task->client->phone }}</p>
                        <span>Manzil: {{ $task->point->address }}</span>
                    </div>
                    <div class="order_navigation">
                        <button>Joylashuv</button>
                    </div>
                </div>
            @endforeach

            <div class="popup__bg">
                <i class="ri-close-line close-popup" onclick="closePopup()"></i>
                <div class="popup">
                    <div class="info">
                        <div>
                            <span>F.I.O</span>
                            <p id="popup_name"></p>
                        </div>
                        <div>
                            <span>Telefon raqami</span>
                            <p id="popup_phone"></p>
                        </div>
                        <div>
                            <span>Manzil</span>
                            <p id="popup_address"></p>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="#" style="width: 29%;" class="green">Joylashuv</a>
                        <a href="" style="width: 19%;" class="orange"><i class="ri-phone-line"></i></a>
                        <a href="{{route('mobile.agent.task_items', ['token' => $token])}}" style="width: 49%;" class="blue">Xizmat ko'rsatish</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
