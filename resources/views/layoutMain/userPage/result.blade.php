<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tính phí vận chuyển</title>
</head>
<body>
    <div class="container">
        <h1>Kết quả tính phí vận chuyển</h1>
        <p>Tổng phí vận chuyển: {{ number_format($cost, 0, ',', '.') }} VND</p>
        <a href="{{ url()->previous() }}">Quay lại</a>
    </div>
</body>
</html>
