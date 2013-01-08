<?php
    error_reporting( E_ERROR | E_WARNING );
    //�ϴ�����
    $config = array(
        "uploadPath" => "upload/" , //����·��
        "fileType" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" ) , //�ļ�������ʽ
        "fileSize" => 1000 //�ļ���С���ƣ���λKB
    );
    //ԭʼ�ļ������������̶�����������
    $oriName = htmlspecialchars( $_POST[ 'fileName' ] , ENT_QUOTES );

    //�ϴ�ͼƬ���е������������ƣ�
    $title = htmlspecialchars( $_POST[ 'pictitle' ] , ENT_QUOTES );

    //�ļ����
    $file = $_FILES[ "upfile" ];

    //�ļ��ϴ�״̬,���ɹ�ʱ����SUCCESS������ֵ��ֱ�ӷ��ض�Ӧ�ַ��ܲ���ʾ��ͼƬԤ����ͬʱ������ǰ��ҳ��ͨ���ص�������ȡ��Ӧ�ַ���
    $state = "SUCCESS";

    //����������ļ���
    $fileName = "";

    //����·��
    $path = $config[ 'uploadPath' ];

    if ( !file_exists( $path ) ) {
        mkdir( "$path" , 0777 );
    }
    //��ʽ��֤
    $current_type = strtolower( strrchr( $file[ "name" ] , '.' ) );
    if ( !in_array( $current_type , $config[ 'fileType' ] ) || false == getimagesize( $file[ "tmp_name" ] ) ) {
        $state = "��������ͼƬ��ʽ";
    }
    //��С��֤
    $file_size = 1024 * $config[ 'fileSize' ];
    if ( $file[ "size" ] > $file_size ) {
        $state = "ͼƬ��С��������";
    }
    //����ͼƬ
    if ( $state == "SUCCESS" ) {
        $tmp_file = $file[ "name" ];
        $fileName = $path . rand( 1 , 10000 ) . time() . strrchr( $tmp_file , '.' );
        $result = move_uploaded_file( $file[ "tmp_name" ] , $fileName );
        if ( !$result ) {
            $state = "δ֪����";
        }
    }
    //���������������json����
    /**
     * �������ݸ�ʽ
     * {
     *   'url'      :'a.jpg',   //�������ļ�·��
     *   'title'    :'hello',   //�ļ���������ͼƬ��˵��ǰ�˻����ӵ�title������
     *   'original' :'b.jpg',   //ԭʼ�ļ���
     *   'state'    :'SUCCESS'  //�ϴ�״̬���ɹ�ʱ����SUCCESS,�����κ�ֵ��ԭ��������ͼƬ�ϴ�����
     * }
     */
    echo "{'url':'" . $fileName . "','title':'" . $title . "','original':'" . $oriName . "','state':'" . $state . "'}";

?>

