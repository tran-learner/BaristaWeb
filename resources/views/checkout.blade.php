@extends('generalTemp')
@section('specifyContent')
@section('background' , 'backgroundDrinkList')
        <div class="main-box">
            <div class="checkout">
                <div class="product">
                    <p><strong>Tên sản phẩm:</strong> Mì tôm Hảo Hảo ly</p>
                    <p><strong>Giá tiền:</strong> 2000 VNĐ</p>
                    <p><strong>Số lượng:</strong> 1</p>
                </div>
                <form action="/create-payment-link" method="get">
                    <button type="submit" id="create-payment-link-btn">
                        Tạo Link thanh toán
                    </button>
                </form>
            </div>
        </div>
@endsection
