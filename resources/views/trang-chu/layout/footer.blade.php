    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Xử lý phân trang TIN
    $(document).on('click', '#tin-moi-nhat-container .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                type: 'tin'
            },
            success: function(data) {
                $('#tin-moi-nhat-container').html(data); // Gắn đúng vào container tin
            },
            error: function(xhr) {
                alert('Lỗi tải dữ liệu.');
            }
        });
    });

    // Xử lý phân trang VĂN BẢN
    $(document).on('click', '#van-ban-moi-container .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            data: {
                type: 'vanban' // ✅ Đúng kiểu
            },
            success: function(data) {
                $('#van-ban-moi-container').html(data); // ✅ Gắn vào đúng nơi
            },
            error: function(xhr) {
                alert('Lỗi tải dữ liệu.');
            }
        });
    });
</script>





<footer class="site-footer">
            <div class="container-fluid">
            <hr>
                <div class="row">
                    <div class="col-md-6" style="padding-left: 2rem;">
                        <h6>PHÒNG THANH TRA - PHÁP CHẾ - SỞ HỮU TRÍ TUỆ <br> TRƯỜNG ĐẠI HỌC AN GIANG</h6>
                        <ul class="footer-links" style="list-style: none;">
                            <li><i class="fa-solid fa-location-dot fa-bounce" style="color: #63E6BE;"></i><a href=""> &ensp;18 Ung Văn Khiêm, P. Đông xuyên, TP. Long Xuyên, An Giang</a></li>
                            <li><i class="fa-solid fa-square-envelope fa-beat-fade" style="color: #63E6BE;"></i> <a href="#">&ensp;lid@agu.edu.vn</a></li>
                            <li><i class="fa-solid fa-phone-volume fa-shake" style="color: #63E6BE;"></i><a href="">&ensp;(076).945454 - (234)</a></li>
                            <li><i class="fa-solid fa-globe fa-shake" style="color: #63E6BE;"></i><a href="">&ensp;lid.agu.edu.vn</a></li>
                        </ul>
                    </div>

                    <div class="col-md-6" style="padding-left: 2rem; ">
                        <h6>LIÊN KẾT</h6>
                        <ul class="footer-links " style="list-style: none;">
                            <li><i class="fa-solid fa-book" style="color: #63E6BE;"></i> <a href="https://vnuhcm.edu.vn/ve-dhqg-hcm/33393364/303364/31313364">&ensp;Tủ sách pháp luật điện tử</a></li>
                            <li><i class="fa-solid fa-scale-balanced" style="color: #63E6BE;"></i><a href="https://pbgdpl.moj.gov.vn/Pages/Trang-chu.aspx">&ensp;Giáo dục pháp luật</a></li>
                            <li><i class="fa-solid fa-scale-unbalanced" style="color: #63E6BE;"></i> <a href="https://moet.gov.vn/Pages/home.aspx">&ensp;Bộ giáo dục và đào tạo</a></li>
                            <li><i class="fa-solid fa-binoculars" style="color: #63E6BE;"></i> <a href="https://thanhtra.gov.vn/">&ensp;Thanh tra chính phủ</a></li>
                            <li><i class="fa-solid fa-scale-unbalanced-flip" style="color: #63E6BE;"></i><a href="https://moj.gov.vn/Pages/home.aspx">&ensp;Bộ tư pháp</a></li>
                        </ul>
                    </div>
                </div>
            <hr>
            </div>

            <div class="container-fluid">
                <div class="row" style="padding-left: 2rem;">
                    <p class="copyright-text">© Copyright 2024. Phát triển bởi
                    <a class="ttth" href="https://cict.agu.edu.vn">Trung tâm tin học Trường Đại học An Giang</a>
                    </p>
                </div>
            </div>
            <script src="https://kit.fontawesome.com/2038322d50.js" crossorigin="anonymous"></script>
 </footer>