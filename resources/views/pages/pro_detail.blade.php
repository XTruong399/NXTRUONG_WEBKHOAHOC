@extends('layout')
@section('content')
   <style>
.course-container {
    display: flex;
    flex-wrap: wrap;
    margin: 20px;
}

.video-section {
    flex: 2;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
}

video {
    width: 100%;
    border-radius: 8px;
}

.content-section {
    flex: 1;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-height: 600px;
    overflow-y: auto;
}

.content-section h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.accordion {
    border-top: 1px solid #ddd;
}

.accordion-item {
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
}

.accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 10px 0;
    font-weight: bold;
    color: #444;
}

.accordion-content {
    list-style: none;
    margin: 0;
    padding: 0;
}

.lesson {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-top: 1px solid #f0f0f0;
    color: #555;
}

.lesson.locked {
    color: #aaa;
}

.lesson.locked span:last-child {
    color: #aaa;
}

.lesson:hover {
    color: #007bff;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="course-container">
        <!-- Video player section -->
        <div class="video-section">
            <video controls>
                <source src="{{ asset('/public/frontend/video/demo.mp4') }}" type="video/mp4">
                Trình duyệt của bạn không hỗ trợ phát video.
            </video>
        </div>

        <!-- Course content -->
        <div class="content-section">
            <h1>Nội dung khóa học</h1>
            <div class="accordion">
                <!-- Accordion item -->
                <div class="accordion-item">
                    <div class="accordion-header">
                    <h3>{{ $product->Pro_name }}</h3>
                    <p>Mô tả: {{ $product->description }}</p>
                        <p>0/9 | 1:46:19</p>
                    </div>
                    <ul class="accordion-content">
                        <li class="lesson">
                            <span>1. Giới thiệu</span>
                            <span>01:48</span>
                        </li>
                        <li class="lesson locked">
                            <span>2. IIFE là gì?</span>
                            <span>23:57</span>
                        </li>
                        <li class="lesson">
                            <span> Giới thiệu 1</span>
                            <span>01:48</span>
                        </li>
                        <li class="lesson">
                            <span>1. Giới thiệu 2</span>
                            <span>01:48</span>
                        </li>
                        <li class="lesson">
                            <span>1. Giới thiệu 3</span>
                            <span>01:48</span>
                        </li>
                        <li class="lesson">
                            <span>1. Giới thiệu 4</span>
                            <span>01:48</span>
                        </li>
                        <li class="lesson">
                            <span>. Giới thiệu 5</span>
                            <span>01:48</span>
                        </li>
                    </ul>
                </div>

                <!-- Add more accordion items -->
            </div>
        </div>
    </div>
</body>
<script>
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
@endsection