@extends('layouts.admin.app')

@section('title', 'Invoice Details')

@section('content')
    <x-admin.page title="Invoice Details">
        <x-slot name="header">
            {{-- <x-admin.page-button :href="route('admin.invoice.index')" title="Back to Invoice List" icon="back" /> --}}
            @can('edit_invoice')
                <x-admin.page-button :href="route('admin.invoice.edit', $quote->id)" title="Send invoice" icon="invoice" id="invoiceBtn" />
            @endcan
        </x-slot>

        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4"  style=" width: 100%; max-width: 800px; margin: auto">
                <div class="w-100">
                    <svg viewBox="0 0 330 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="186" height="47" fill="#F5F5F5"/>
                        <rect width="1440" height="4121" transform="translate(-220 -60)" fill="white"/>
                        <g clip-path="url(#clip0_0_1)">
                        <path d="M0 0V47H46.6367V0H0ZM14.2255 32.6971H13.5295L23.0988 14.3112H27.9704L25.0624 19.8888L18.3929 32.6971H14.2172H14.2255ZM19.8179 32.6971L26.4874 19.8888L33.1155 32.6971H19.8179Z" fill="black"/>
                        <path d="M57.001 0H54.0598V19.655H57.001V0Z" fill="black"/>
                        <path d="M76.8273 4.71753C75.7751 4.71753 74.8638 4.95132 74.1015 5.4189C73.3393 5.88648 72.7842 6.52105 72.4362 7.30591H72.2871C71.9723 6.496 71.4835 5.86978 70.8207 5.41055C70.1578 4.95132 69.3376 4.71753 68.36 4.71753C67.3823 4.71753 66.5704 4.94297 65.8745 5.4022C65.1868 5.86143 64.6814 6.496 64.3831 7.30591H64.2009V4.90957H61.4668V19.6466H64.3169V10.5623C64.3169 9.89429 64.4577 9.30982 64.7311 8.80884C65.0045 8.29952 65.3691 7.90708 65.8247 7.6232C66.2804 7.33931 66.7775 7.19737 67.3161 7.19737C68.1114 7.19737 68.7577 7.4395 69.2465 7.92378C69.7436 8.40806 69.9921 9.05098 69.9921 9.85254V19.6466H72.8256V10.2533C72.8256 9.35992 73.0825 8.62515 73.5962 8.04903C74.1098 7.4729 74.8306 7.18902 75.7586 7.18902C76.5042 7.18902 77.1504 7.41446 77.689 7.85699C78.2275 8.30786 78.5009 9.02593 78.5009 10.0279V19.6466H81.351V9.7607C81.351 8.07408 80.9284 6.80493 80.0917 5.96997C79.2466 5.13501 78.1695 4.71753 76.8439 4.71753H76.8273Z" fill="black"/>
                        <path d="M101.774 7.86535C102.312 8.31623 102.586 9.03429 102.586 10.0362V19.655H105.436V9.76906C105.436 8.08244 105.013 6.8133 104.176 5.97833C103.331 5.14337 102.254 4.72589 100.929 4.72589C99.8764 4.72589 98.9651 4.95968 98.2029 5.42726C97.4406 5.89484 96.8855 6.52941 96.5376 7.31427H96.3884C96.0736 6.50436 95.5848 5.87814 94.922 5.41891C94.2592 4.95968 93.4389 4.72589 92.4613 4.72589C91.4837 4.72589 90.6717 4.95133 89.9758 5.41056C89.2881 5.86979 88.7827 6.50436 88.4845 7.31427H88.3022V4.91793H85.5681V19.655H88.4182V10.5706C88.4182 9.90265 88.559 9.31818 88.8324 8.8172C89.1058 8.30788 89.4704 7.91545 89.9261 7.63156C90.3817 7.34767 90.8788 7.20573 91.4174 7.20573C92.2127 7.20573 92.859 7.44787 93.3478 7.93214C93.8449 8.41642 94.0935 9.05934 94.0935 9.86091V19.655H96.927V10.2617C96.927 9.36828 97.1838 8.63351 97.6975 8.05739C98.2111 7.48126 98.9319 7.19738 99.8599 7.19738C100.606 7.19738 101.252 7.42282 101.79 7.86535H101.774Z" fill="black"/>
                        <path d="M118.8 19.4546C119.636 19.129 120.332 18.6614 120.887 18.0602C121.442 17.4591 121.832 16.766 122.047 15.9645L119.355 15.4719C119.181 15.9311 118.932 16.3235 118.609 16.6325C118.286 16.9414 117.905 17.1835 117.457 17.3338C117.01 17.4925 116.521 17.5676 115.983 17.5676C115.154 17.5676 114.425 17.3839 113.804 17.0249C113.182 16.6659 112.693 16.1398 112.354 15.4468C112.031 14.8039 111.881 14.0274 111.857 13.134H122.238V12.1153C122.238 10.7794 122.056 9.64382 121.708 8.70032C121.351 7.76516 120.871 6.99699 120.249 6.41252C119.636 5.8197 118.94 5.39387 118.162 5.11833C117.383 4.84279 116.587 4.7092 115.759 4.7092C114.4 4.7092 113.215 5.03483 112.205 5.67775C111.194 6.32067 110.407 7.22243 109.843 8.37468C109.28 9.52693 108.998 10.8545 108.998 12.3658C108.998 13.8771 109.28 15.2297 109.843 16.3653C110.407 17.5008 111.202 18.3775 112.246 19.0037C113.282 19.63 114.524 19.9389 115.966 19.9389C117.035 19.9389 117.979 19.7719 118.816 19.4463L118.8 19.4546ZM112.304 9.21799C112.627 8.58342 113.083 8.07409 113.671 7.68166C114.268 7.28923 114.964 7.08884 115.759 7.08884C116.496 7.08884 117.134 7.25583 117.689 7.59817C118.236 7.9405 118.667 8.39973 118.974 8.9842C119.28 9.56868 119.429 10.2366 119.429 10.9965H111.848C111.882 10.3619 112.022 9.76907 112.296 9.21799H112.304Z" fill="black"/>
                        <path d="M133.622 7.5063V4.75927C133.481 4.74257 133.29 4.72587 133.042 4.70917C132.801 4.69247 132.586 4.69247 132.412 4.69247C131.559 4.69247 130.788 4.92626 130.109 5.37714C129.429 5.83637 128.965 6.46259 128.692 7.25581H128.543V4.90956H125.792V19.6466H128.642V10.6458C128.642 10.0028 128.791 9.43506 129.098 8.93408C129.405 8.4331 129.819 8.04067 130.341 7.75678C130.863 7.4729 131.459 7.33095 132.139 7.33095C132.429 7.33095 132.719 7.34765 133.017 7.3894C133.307 7.43115 133.514 7.46455 133.622 7.49795V7.5063Z" fill="black"/>
                        <path d="M143.746 11.3972L141.426 10.8629C140.623 10.6708 140.034 10.4287 139.67 10.1281C139.305 9.82751 139.131 9.42673 139.131 8.9341C139.131 8.36632 139.405 7.89875 139.943 7.53971C140.482 7.18068 141.153 6.99699 141.965 6.99699C142.553 6.99699 143.05 7.08883 143.439 7.28087C143.829 7.47292 144.144 7.71505 144.376 8.01564C144.608 8.31623 144.782 8.63351 144.881 8.9675L147.458 8.50827C147.168 7.35602 146.563 6.43756 145.66 5.75289C144.749 5.06823 143.506 4.72589 141.923 4.72589C140.821 4.72589 139.852 4.90958 138.999 5.27697C138.145 5.64435 137.483 6.15368 137.002 6.80495C136.521 7.45622 136.281 8.21603 136.281 9.09274C136.281 10.1448 136.604 11.0132 137.259 11.6895C137.913 12.3741 138.916 12.8751 140.283 13.1841L142.76 13.7351C143.456 13.8938 143.978 14.1276 144.318 14.4448C144.657 14.7538 144.823 15.1462 144.823 15.6054C144.823 16.1732 144.541 16.6575 143.986 17.0499C143.431 17.4424 142.686 17.6427 141.749 17.6427C140.896 17.6427 140.2 17.4591 139.661 17.0917C139.131 16.7243 138.775 16.1816 138.601 15.4552L135.85 15.881C136.082 17.1835 136.72 18.1938 137.756 18.8952C138.792 19.6049 140.125 19.9556 141.766 19.9556C142.951 19.9556 143.986 19.7636 144.881 19.3711C145.776 18.9787 146.48 18.4443 146.985 17.7513C147.491 17.0666 147.739 16.2818 147.739 15.3967C147.739 14.353 147.408 13.5097 146.745 12.8501C146.082 12.1988 145.08 11.7145 143.738 11.3972H143.746Z" fill="black"/>
                        <path d="M154.119 4.90958H151.269V19.6467H154.119V4.90958Z" fill="black"/>
                        <path d="M164.102 16.2567H163.953L160.25 4.90958H157.193L162.503 19.655H165.552L170.855 4.90958H167.798L164.102 16.2567Z" fill="black"/>
                        <path d="M186 12.132C186 10.7961 185.818 9.66051 185.47 8.71701C185.113 7.78185 184.633 7.01369 184.011 6.42921C183.398 5.83639 182.702 5.41056 181.924 5.13502C181.145 4.85949 180.349 4.72589 179.521 4.72589C178.162 4.72589 176.977 5.05153 175.967 5.69445C174.956 6.33737 174.169 7.23913 173.605 8.39137C173.042 9.54362 172.76 10.8712 172.76 12.3825C172.76 13.8938 173.042 15.2464 173.605 16.382C174.169 17.5175 174.964 18.3942 176.008 19.0204C177.044 19.6467 178.286 19.9556 179.728 19.9556C180.797 19.9556 181.741 19.7886 182.578 19.463C183.415 19.1373 184.111 18.6698 184.666 18.0686C185.221 17.4674 185.61 16.7744 185.826 15.9728L183.133 15.4802C182.959 15.9394 182.711 16.3319 182.388 16.6408C182.064 16.9497 181.683 17.1919 181.236 17.3422C180.788 17.5008 180.3 17.576 179.761 17.576C178.933 17.576 178.204 17.3923 177.582 17.0332C176.961 16.6742 176.472 16.1482 176.132 15.4552C175.809 14.8122 175.66 14.0357 175.635 13.1423H186.016V12.1237L186 12.132ZM175.635 10.9965C175.668 10.3619 175.809 9.76906 176.083 9.21799C176.406 8.58341 176.861 8.07409 177.45 7.68166C178.046 7.28922 178.742 7.08883 179.537 7.08883C180.275 7.08883 180.913 7.25583 181.468 7.59816C182.015 7.94049 182.446 8.39972 182.752 8.9842C183.059 9.56867 183.208 10.2366 183.208 10.9965H175.627H175.635Z" fill="black"/>
                        <path d="M65.9657 37.1474C65.3443 36.7634 64.7147 36.5546 64.0684 36.5212V36.3292C64.6649 36.1789 65.2118 35.9284 65.7089 35.5944C66.206 35.2604 66.6037 34.8095 66.9019 34.2501C67.2002 33.6907 67.3493 32.9977 67.3493 32.1794C67.3493 31.2025 67.1256 30.3341 66.6699 29.5576C66.2143 28.7811 65.5432 28.1632 64.6318 27.704C63.7204 27.2448 62.5771 27.0193 61.1935 27.0193H54.0518V46.6744H61.5249C63.0328 46.6744 64.2755 46.4406 65.2449 45.9813C66.2143 45.5138 66.9351 44.8875 67.399 44.0943C67.863 43.3011 68.1033 42.3993 68.1033 41.389C68.1033 40.3787 67.8961 39.5104 67.4902 38.8007C67.0842 38.0909 66.5705 37.5399 65.9491 37.1558L65.9657 37.1474ZM57.0013 29.5409H61.0195C62.1877 29.5409 63.0576 29.8165 63.621 30.3675C64.1844 30.9186 64.4661 31.5949 64.4661 32.4132C64.4661 33.0478 64.3087 33.5905 63.9939 34.0581C63.679 34.5257 63.2565 34.8847 62.7262 35.1352C62.196 35.394 61.5995 35.5193 60.9367 35.5193H56.993V29.5409H57.0013ZM64.2755 43.3011C63.6625 43.8522 62.66 44.1277 61.2515 44.1277H57.0013V37.8321H61.3509C62.138 37.8321 62.8174 37.9824 63.389 38.2913C63.9607 38.6003 64.4081 39.0094 64.7147 39.5271C65.0295 40.0448 65.1786 40.6125 65.1786 41.2387C65.1786 42.0654 64.8721 42.75 64.2673 43.3011H64.2755Z" fill="black"/>
                        <path d="M78.7663 31.7118C77.9129 31.7118 77.1424 31.9456 76.463 32.3965C75.7836 32.8557 75.3197 33.482 75.0463 34.2752H74.8971V31.9289H72.1465V46.666H74.9965V37.6651C74.9965 37.0222 75.1457 36.4544 75.4522 35.9534C75.7588 35.4525 76.173 35.06 76.695 34.7762C77.217 34.4923 77.8135 34.3503 78.4929 34.3503C78.7828 34.3503 79.0728 34.367 79.3711 34.4088C79.6611 34.4505 79.8682 34.4839 79.9759 34.5173V31.7703C79.835 31.7536 79.6445 31.7369 79.3959 31.7202C79.1557 31.7035 78.9402 31.7035 78.7663 31.7035V31.7118Z" fill="black"/>
                        <path d="M92.6023 32.7054C92.0306 32.3381 91.4092 32.0876 90.7547 31.954C90.1002 31.8204 89.4788 31.7452 88.8906 31.7452C88.0123 31.7452 87.1673 31.8705 86.3636 32.121C85.5599 32.3715 84.8557 32.7806 84.2426 33.3317C83.6295 33.8827 83.1656 34.6092 82.8507 35.5026L85.5268 36.1121C85.7339 35.5944 86.115 35.1268 86.6619 34.701C87.2087 34.2752 87.9626 34.0664 88.9237 34.0664C89.8848 34.0664 90.5393 34.3002 91.0032 34.7595C91.4672 35.2187 91.7075 35.8699 91.7075 36.7049V36.7717C91.7075 37.114 91.5832 37.3645 91.3346 37.5232C91.0861 37.6735 90.6884 37.7904 90.1416 37.8572C89.5948 37.924 88.8823 38.0075 88.0123 38.116C87.3164 38.1995 86.6453 38.3247 85.9742 38.4834C85.3114 38.642 84.7066 38.8842 84.1681 39.1931C83.6295 39.5104 83.1987 39.9279 82.8839 40.4706C82.569 41.005 82.4116 41.6896 82.4116 42.5246C82.4116 43.4932 82.627 44.3031 83.0661 44.971C83.497 45.639 84.0935 46.14 84.8391 46.4907C85.5848 46.8413 86.4299 47.0167 87.3495 47.0167C88.1532 47.0167 88.8491 46.8998 89.4291 46.6577C90.009 46.4239 90.4813 46.1233 90.8458 45.7642C91.2104 45.4052 91.4921 45.0378 91.6743 44.6704H91.7903V46.6827H94.5741V36.897C94.5741 35.8199 94.3918 34.9515 94.019 34.2752C93.6462 33.5989 93.1822 33.0812 92.6023 32.7138V32.7054ZM91.724 41.364C91.724 41.9485 91.5749 42.4912 91.2767 43.0005C90.9784 43.5099 90.5559 43.919 89.9925 44.2363C89.4291 44.5452 88.758 44.7038 87.9709 44.7038C87.1838 44.7038 86.5044 44.5202 85.9825 44.1611C85.4605 43.8021 85.2037 43.2594 85.2037 42.558C85.2037 42.0487 85.3363 41.6312 85.6097 41.3223C85.8831 41.0133 86.2393 40.7712 86.695 40.6042C87.1507 40.4372 87.6478 40.3203 88.2029 40.2452C88.4349 40.2118 88.7331 40.17 89.0811 40.1283C89.4291 40.0782 89.7853 40.0281 90.1582 39.9613C90.5227 39.9028 90.8541 39.8277 91.1441 39.7442C91.4341 39.6607 91.6246 39.5605 91.7323 39.4603V41.3556L91.724 41.364Z" fill="black"/>
                        <path d="M108.982 32.3715C108.228 31.954 107.358 31.7452 106.364 31.7452C105.27 31.7452 104.359 31.979 103.638 32.455C102.917 32.9309 102.387 33.5571 102.056 34.3336H101.873V31.9373H99.1392V46.6744H101.989V37.924C101.989 37.1391 102.138 36.4795 102.428 35.92C102.727 35.369 103.124 34.9431 103.638 34.6593C104.152 34.3754 104.732 34.2251 105.394 34.2251C106.355 34.2251 107.118 34.5257 107.673 35.1352C108.228 35.7364 108.501 36.5797 108.501 37.6484V46.6744H111.351V37.2977C111.351 36.0787 111.144 35.06 110.73 34.2334C110.316 33.4068 109.736 32.7889 108.99 32.3631L108.982 32.3715Z" fill="black"/>
                        <path d="M125.801 34.3253H125.627C125.453 34.0163 125.212 33.6656 124.906 33.2565C124.599 32.8557 124.168 32.4967 123.613 32.1961C123.058 31.8955 122.329 31.7369 121.418 31.7369C120.241 31.7369 119.189 32.0375 118.269 32.6386C117.342 33.2398 116.612 34.1082 116.082 35.2354C115.552 36.3709 115.287 37.7319 115.287 39.3267C115.287 40.9215 115.552 42.2824 116.074 43.418C116.596 44.5535 117.325 45.4303 118.245 46.0398C119.173 46.6493 120.216 46.9582 121.401 46.9582C122.288 46.9582 123.017 46.8079 123.572 46.5074C124.127 46.2068 124.574 45.8561 124.889 45.4553C125.212 45.0545 125.453 44.6955 125.627 44.3782H125.867V46.6743H128.651V27.0193H125.801V34.3169V34.3253ZM125.403 42.032C125.105 42.8168 124.674 43.418 124.11 43.8605C123.539 44.2947 122.851 44.5201 122.031 44.5201C121.211 44.5201 120.473 44.2947 119.902 43.8355C119.33 43.3762 118.891 42.7584 118.601 41.9652C118.311 41.1803 118.162 40.2952 118.162 39.31C118.162 38.3247 118.303 37.4647 118.593 36.6882C118.883 35.9117 119.313 35.3022 119.885 34.8596C120.457 34.4088 121.169 34.1833 122.031 34.1833C122.893 34.1833 123.564 34.4004 124.127 34.8262C124.69 35.2521 125.121 35.8532 125.411 36.6214C125.701 37.3896 125.85 38.283 125.85 39.31C125.85 40.337 125.701 41.2554 125.411 42.032H125.403Z" fill="black"/>
                        <path d="M140.73 38.4249L138.41 37.8906C137.607 37.6985 137.018 37.4564 136.654 37.1558C136.289 36.8552 136.115 36.4544 136.115 35.9618C136.115 35.394 136.389 34.9265 136.927 34.5674C137.466 34.2084 138.137 34.0247 138.949 34.0247C139.537 34.0247 140.034 34.1165 140.424 34.3086C140.813 34.5006 141.128 34.7428 141.36 35.0434C141.592 35.3439 141.766 35.6612 141.865 35.9952L144.442 35.536C144.152 34.3837 143.547 33.4653 142.644 32.7806C141.733 32.0959 140.49 31.7536 138.907 31.7536C137.806 31.7536 136.836 31.9373 135.983 32.3047C135.129 32.6721 134.467 33.1814 133.986 33.8327C133.506 34.4839 133.265 35.2437 133.265 36.1205C133.265 37.1725 133.588 38.0409 134.243 38.7172C134.897 39.3935 135.9 39.9028 137.267 40.2118L139.744 40.7628C140.44 40.9215 140.962 41.1553 141.302 41.4726C141.642 41.7815 141.807 42.1739 141.807 42.6332C141.807 43.2009 141.526 43.6852 140.97 44.0776C140.415 44.4701 139.67 44.6705 138.733 44.6705C137.88 44.6705 137.184 44.4868 136.646 44.1194C136.115 43.752 135.759 43.2093 135.585 42.4829L132.834 42.9087C133.066 44.2112 133.704 45.2215 134.74 45.9229C135.776 46.6326 137.11 46.9833 138.75 46.9833C139.935 46.9833 140.97 46.7913 141.865 46.3988C142.76 46.0064 143.464 45.472 143.97 44.779C144.475 44.0943 144.724 43.3095 144.724 42.4244C144.724 41.3807 144.392 40.5374 143.729 39.8778C143.067 39.2265 142.064 38.7422 140.722 38.4249H140.73Z" fill="black"/>
                        <path d="M152.694 0C151.849 0 151.161 0.693018 151.161 1.54468C151.161 2.39634 151.849 3.08936 152.694 3.08936C153.539 3.08936 154.227 2.39634 154.227 1.54468C154.227 0.693018 153.539 0 152.694 0Z" fill="black"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_0_1">
                        <rect width="186" height="47" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>

                </div>
                <div class="text-end">
                    <div style="width:320px" class="fw-semibold text-black fs-4">Immersive Brands Ltd</div>
                    <div class="text-gray fw-semibold" style="font-size: 12px;">14th Floor</div>
                    <div class="text-gray fw-semibold" style="font-size: 12px;">25 Cabot Square</div>
                    <div class="text-gray fw-semibold" style="font-size: 12px;">London E14 4QZ</div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4"  style=" width: 100%; max-width: 800px; margin: auto">
                <div>
                    <div class="fw-semibold fs-4 text-black">No. {{$quote->invoice}}</div>
                    <div class="fw-semibold" style="font-size: 12px;">Date: {{ date('d F Y', strtotime($quote->created_at))}}</div>
                </div>
                <div class="text-end">
                    <span class="text-uppercase fw-medium text-black" style="font-size: 50px; letter-spacing: 3px;">Invoice</span>
                </div>
            </div>

            <div style="max-width: 800px; width: 100%; margin: auto">
                <div class="d-flex">
                    <div>
                        <div style="background-color:#9E9E9E; width: 274px; padding: 5px 0px; text-transform: uppercase; color: white; text-align: center">
                            Invoice To
                        </div>

                        <div class=""  style="background-color:#f2f2f3; width:274px; padding-left: 95px; padding-top: 20px; padding-bottom:20px">
                            <div>
                                <div>
                                    <div style="font-size: 10px; font-weight: 600">{{$quote->user?->name}}</div>
                                    <div class="text-uppercase" style="color:black; font-weight:600; font-size:">{{$quote->user?->company_name}}</div>
                                </div>

                                <div style="margin-top: 20px">
                                    @if($quote->user?->delivery_address != null)
                                        <div style="font-size: 10px; font-weight: 500">{{$quote->user?->delivery_address->address_line_1}}, {{$quote->user?->delivery_address->address_line_2}}</div>
                                        <div style="font-size: 10px; font-weight: 500">{{$quote->user?->delivery_address->city}}</div>
                                        <div style="font-size: 10px; font-weight: 500">{{$quote->user?->delivery_address->state}}</div>
                                        <div style="font-size: 10px; font-weight: 500">{{$quote->user?->delivery_address->country}}</div>
                                    @endif
                                </div>

                                <div style="margin-top: 20px">
                                    <div style="font-size: 10px; font-weight: 600; color: black; line-height: 2">PO Number</div>
                                    @if($quote->user?->delivery_address != null)
                                        <div style="font-size: 10px; font-weight: 500">{{$quote->user?->delivery_address->postcode}}</div>
                                    @endif
                                </div>

                                <div style="margin-top: 20px">
                                    <div class="text-uppercase" style="font-size: 10px; font-weight: 600; color: black; line-height: 2">Bank Details</div>
                                    <div style="font-size: 10px; font-weight: 500">Name: Immersive Brands Ltd</div>
                                    <div style="font-size: 10px; font-weight: 500">Bank Name: Metro Bank</div>
                                    <div style="font-size: 10px; font-weight: 500">Account Number: 47870479</div>
                                    <div style="font-size: 10px; font-weight: 500">Sort Code: 23-05-80</div>
                                    <div style="font-size: 10px; font-weight: 500; margin-top: 20px">VAT: 434 2299 96</div>
                                    <div style="font-size: 10px; font-weight: 500; margin-top: 20px">@if($quote->account_type != null)Terms: {{$quote->account_type}}@endif</div>
                                </div>
                            </div>

                            <div>
                                <div style="margin-top: 150px">
                                    <div class="text-uppercase" style="font-size: 10px; font-weight: 600; color: black; line-height: 2">Contact</div>
                                    <div style="font-size: 10px; font-weight: 500; margin-top: 10px">020 3005 3217</div>
                                    <div style="font-size: 10px; font-weight: 500; margin-top: 5px">info@immersivebrands.co.uk</div>
                                </div>

                                <div style="border-top: 6px solid gray; width: 30px; margin: 30px 0px;">

                                </div>


                                <div class="text-uppercase" style="font-size: 16px; font-weight: 600; color: black">
                                    This is not <br> a tax invoice
                                </div>

                                <div style="margin-top: 40px">
                                    <div style="font-size: 10px; font-weight: 500; color: black">
                                        Company Registration No.
                                    </div>
                                    <div style="font-size: 10px; font-weight: 500; color: black">
                                        14617141.
                                    </div>
                                </div>

                                <div style="margin-top: 20px">
                                    <div style="font-size: 10px; font-weight: 500; color: black">Regitered Office</div>
                                    <div style="font-size: 10px; font-weight: 500; color: black">14th Floor, 25 Cabot Square,</div>
                                    <div style="font-size: 10px; font-weight: 500; color: black">London, London, E14 4QZ,</div>
                                    <div style="font-size: 10px; font-weight: 500; color: black">United Kingdom.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="position: relative">
                        <div>
                            <table>
                                <thead style="background-color: #9E9E9E;">
                                    <td width="10%" style=" padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">No.</td>
                                    <td width="40%" style=" padding: 5px 0px; text-transform: uppercase; color: white;">Description</td>
                                    <td width="15%" style=" padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">QTY</td>
                                    <td width="15%" style=" padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">Unit</td>
                                    <td width="10%" style=" padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">Setup</td>
                                    <td width="15%" style=" padding: 5px 0px; text-align:center; text-transform: uppercase; color: white;">Price</td>
                                </thead>

                                <tbody>
                                    @php
                                        $subtotal = $quote->items->sum('subtotal');
                                        $total_vat = $quote->items->sum('vat_amount');
                                        $total = $quote->items->sum('total') + $quote->shipping_amount;
                                    @endphp

                                    @foreach($quote->items as $item)
                                        <tr>
                                            <td style="width: 50px; text-align:center; font-size: 12px; font-weight: 600; color: black">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td style="width: 270px; border-bottom: 2px solid #f2f2f3">
                                                <div style="font-size: 12px; font-weight: 600; color: black; margin-top: 10px">{{$item->product?->name ? $item->product?->name : $item->product_name}}</div>
                                                <div style="font-size: 10px; font-weight: 500; margin-top: 10px">{{$item->product?->description ? $item->product?->description : $item->product_description}}</div>
                                            </td>
                                            <td style="width: 116px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                                {{$item->quantity}}
                                            </td>
                                            <td style="width: 118px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                                {{$item->unit_price}}
                                            </td>
                                            <td style="width: 118px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                                {{$item->setup_price}}
                                            </td>
                                            <td style="width: 118px; text-align:center; font-size: 11px; font-weight: 500; border-bottom: 2px solid #f2f2f3">
                                                {{$item->subtotal}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">Sub Total</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 5px">{{convertAmount($subtotal)}}</div>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">Discount</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;padding-right: 5px">{{ convertAmount($quote->total_discount) }}</div>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">Shipping</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 5px">{{ convertAmount($quote->shipping_amount) }}</div>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">VAT</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 5px">{{convertAmount($total_vat)}}</div>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">Grand Total</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 5px">{{convertAmount($total)}}</div>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">Paid Till Date</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 5px">{{convertAmount($quote->paid_amount)}}</div>
                        </div>
                        <div class="d-flex justify-content-between" style="width:185px; margin-left:auto; border-bottom:  2px solid #f2f2f3; padding: 10px 0px">
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase;">Due</div>
                            <div style="color: black; font-weight: 600; font-size: 11px; text-transform: uppercase; padding-right: 5px">{{convertAmount(($total - $quote->paid_amount))}}</div>
                        </div>

                        <div style="text-transform: uppercase; position: absolute; bottom: 0; right:0; text-align:end; font-size: 25px; font-weight: 600; color: black">
                            <div>Thank you</div>
                            <div>For your business</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.page>
@endsection
