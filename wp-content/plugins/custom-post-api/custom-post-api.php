<?php
/**
 * Plugin Name: Custom Post API
 * Description: API custom untuk mengambil data posting dan parsing tabel di konten (judul, tanggal penetapan, tanggal pengundangan, nomor, singkatan jenis).
 * Version: 1.5
 * Author: JDIH UNAIR
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'rest_api_init', function () {
    // Endpoint default: semua post
    register_rest_route(
        'api/v1',
        '/posts',
        array(
            'methods'             => 'GET',
            'callback'            => 'cpa_get_custom_posts_parsed',
            'permission_callback' => '__return_true',
        )
    );

    // Endpoint baru: berdasarkan kategori
    register_rest_route(
        'api/v1',
        '/posts/kategori/(?P<slug>[a-zA-Z0-9-_]+)',
        array(
            'methods'             => 'GET',
            'callback'            => 'cpa_get_custom_posts_by_category',
            'permission_callback' => '__return_true',
        )
    );
});

/**
 * Fungsi utama: ambil & parsing post
 */
function cpa_get_custom_posts_parsed( $args = array() ) {
    $default_args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );
    $query = new WP_Query( wp_parse_args( $args, $default_args ) );

    $varjson = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();

            $content = apply_filters( 'the_content', get_the_content() );

            // Default nilai
            $judul_tbl = $tanggal_penetapan = $tanggal_pengundangan = $no_panggil = $singkatan_jenis = $tempat_terbit =
            $penerbit = $deskripsi_fisik = $sumber = $subjek = $isbn = $status = $bahasa = $bidang_hukum =
            $teu_badan = $nomor_induk_buku = $file_download = $url_download = $url_detail_peraturan = null;

            // Parsing konten
            if (!empty($content)) {
                libxml_use_internal_errors(true);
                $doc = new DOMDocument();
                $html = '<!DOCTYPE html><html><body>' . $content . '</body></html>';
                $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

                if (@$doc->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)) {
                    $rows = $doc->getElementsByTagName('tr');
                    foreach ($rows as $row) {
                        $cols = $row->getElementsByTagName('td');
                        if ($cols->length >= 2) {
                            $key = trim($cols->item(0)->textContent ?? '');
                            $val = trim($cols->item(1)->textContent ?? '');
                            $normalized_key = preg_replace('/\s+/', ' ', mb_strtolower($key));

                            switch ($normalized_key) {
                                case 'judul': $judul_tbl = $val; break;
                                case 'tanggal penetapan':
                                case 'tanggalpenetapan':
                                case 'tanggal-penetapan': $tanggal_penetapan = $val; break;
                                case 'tanggal pengundangan':
                                case 'tanggalpengundangan':
                                case 'tanggal-pengundangan': $tanggal_pengundangan = $val; break;
                                case 'no panggil':
                                case 'nopanggil':
                                case 'no-panggil':
                                case 'nomor panggil':
                                case 'nomorpanggil':
                                case 'nomor-panggil': $no_panggil = $val; break;
                                case 'singkatan jenis': $singkatan_jenis = $val; break;
                                case 'tempat terbit':
                                case 'tempatiterbit':
                                case 'tempat-terbit': $tempat_terbit = $val; break;
                                case 'penerbit': $penerbit = $val; break;
                                case 'deskripsi fisik':
                                case 'deskripsifisik':
                                case 'deskripsi-fisik': $deskripsi_fisik = $val; break;
                                case 'sumber': $sumber = $val; break;
                                case 'subjek': $subjek = $val; break;
                                case 'isbn': $isbn = $val; break;
                                case 'status': $status = $val; break;
                                case 'bahasa': $bahasa = $val; break;
                                case 'bidang hukum':
                                case 'bidanghukum':
                                case 'bidang-hukum': $bidang_hukum = $val; break;
                                case 't.e.u badan':
                                case 'teu badan':
                                case 'teubadan':
                                case 'teu-badan': $teu_badan = $val; break;
                                case 'nomor induk buku':
                                case 'nomorindukbuku':
                                case 'nomor-induk-buku': $nomor_induk_buku = $val; break;
                                case 'file download':
                                case 'filedownload':
                                case 'file-download': $file_download = $val; break;
                                case 'url download':
                                case 'urldownload':
                                case 'url-download': $url_download = $val; break;
                                case 'url detail peraturan':
                                case 'urldetailperaturan':
                                case 'url-detail-peraturan': $url_detail_peraturan = $val; break;
                            }
                        }
                    }

                    // Ambil link pertama
                    $links = $doc->getElementsByTagName('a');
                    foreach ($links as $link) {
                        $href = $link->getAttribute('href');
                        if (!empty($href) && empty($url_download)) {
                            $url_download = $href;
                            break;
                        }
                    }
                }
                libxml_clear_errors();
            }

            // Response
            $row_array = array(
                'idData' => get_the_ID(),
                'tanggal_penetapan' => $tanggal_penetapan,
                'tanggal_pengundangan' => $tanggal_pengundangan,
                'noPeraturan' => get_the_title(),
                'judul' => $judul_tbl,
                'noPanggil' => $no_panggil,
                'singkatanJenis' => $singkatan_jenis,
                'tempatTerbit' => $tempat_terbit,
                'penerbit' => $penerbit,
                'deskripsiFisik' => $deskripsi_fisik,
                'sumber' => $sumber,
                'subjek' => $subjek,
                'isbn' => $isbn,
                'status' => $status,
                'bahasa' => $bahasa,
                'bidangHukum' => $bidang_hukum,
                'teuBadan' => $teu_badan,
                'nomorIndukBuku' => $nomor_induk_buku,
                'fileDownload' => $file_download,
                'urlDownload' => $url_download,
                'urlDetailPeraturan' => $url_detail_peraturan,
                'operasi' => "4",
                'display' => "1"
            );
            
            $varjson[] = $row_array;
        }
        wp_reset_postdata();
        
        return rest_ensure_response($varjson);
    } else {
        return rest_ensure_response(array('message' => '0 results'));
    }
}

/**
 * Endpoint: ambil data berdasarkan kategori produk hukum
 */
function cpa_get_custom_posts_by_category( $request ) {
    $slug = sanitize_text_field( $request['slug'] );

    $args = array(
        'category_name'  => $slug, // slug kategori
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    return cpa_get_custom_posts_parsed( $args );
}
