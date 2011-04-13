<?php
    // The $body_* variables are for compatibility with pre-existing css
    $page_title = 'Tentang Mozilla';
    
    $pageid = 'about';
    require_once "{$config['file_root']}/includes/l10n/controller.inc.php";
?>

<div id="main-feature">
    <h2>Baik untuk Web.<br />Baik untuk Dunia.</h2>
</div>

<div id="content">

<p>Mozilla bukanlah perusahaan pengembang perangkat lunak biasa. Kami adalah <a href="/<?=$lang?>/firefox/community/">komunitas</a> global yang berdedikasi untuk membangun produk dan teknologi perangkat lunak bebas open source yang dapat menambah pengalaman menjelajah daring bagi semua orang di manapun mereka berada. Kami terdiri dari para programmer, tim marketing, penguji, dan pengacara dari seluruh penjuru dunia yang bekerja sama untuk memastikan Web tetap menjadi sumber daya publik bersama. Kami percaya bahwa standard terbuka dapat memberdayakan pilihan dan inovasi agar semua orang, di manapun mereka berada, mendapatkan pengalaman teraman, tercepat, dan terbaik saat menjelajah daring.</p>

<p><a href="/<?=$lang?>/products/">Produk perangkat lunak</a> dan <a href="http://www.mozilla.org/projects/">teknologi</a> open source kami yang telah memenangi berbagai penghargaan, kami tawarkan secara gratis - tanpa biaya - untuk semua orang dalam lebih dari 40 bahasa.</p>

<p>Mozilla berpusat di <a href="/<?=$lang?>/about/contact.html">Mountain View, California</a> dengan <a href="/<?=$lang?>/about/contact.html">kantor regional</a> di  Auckland, Beijing, Kopenhagen, Paris, Tokyo, dan Toronto.</p>

</div>

<?php
    include_once "{$config['file_root']}/includes/l10n/footer-pages.inc.php";
?>
