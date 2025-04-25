## install packages
npm install tailwindcss @tailwindcss/vite
cài thư viện payos

---------------------------------------------------------------------------------
Cấu trúc project:
1. Routes: routes\web.php
    - Tất cả các routes của project phải được khai báo trong file này để route đó hoạt động được.
2. Controllers: nằm trong thư mục app\Http\Controllers
    - Lấy dữ liệu của món nước từ danh sách các món trong file config\drinks\drinkData.php.
    - Truyền dữ liệu đó xuống View tương ứng.
    - Xử lý logic các tham số truyền xuống view nếu cần tới.
3. Views: nằm trong thư mục resources\views
    - Về cơ bản là file HTML.
    - welcome.blade.php là khung sườn chung cho tất cả các trang khác (gồm tiêu đề, các nút điều khiển, layout cho nội dung)
    - Các file khác dùng lại layout của file welcome thông qua @extend('...') và nội dung riêng của từng trang được thể hiện trong phần @section('...')

##---------------------------------------------
Set up project
1. Chạy composer install để cài các package cần thiết
...
2. Để chạy pj trong dev mode, tại thư mục root của pj
    npm run dev
    php artisan serve (ở terminal khác)
3. Để test web so với khi deploy trên Render, chạy
    npm run build
    php artisan serve (không cần mở terminal khác)


##---------------------------------------------
- Hiện đã kết nối tới CSDL supabase nhưng chưa dùng tới.
- Dữ liệu đồ uống đang được lưu trong file config\drinks\drinkData.php
- Hình ảnh cho từng món ở trong thư mục public\images 