<?php

function tampilan($halaman, $data = [])
{
    echo view('templates/v_header', $data);
    echo view('templates/v_sidebar');
    echo view('templates/v_topbar');
    echo view($halaman, $data);
    echo view('templates/v_footer');

}
                