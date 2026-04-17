<!DOCTYPE html>
<html>

<head>
    <title id="pageTitle">Preview</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            background: #f1f5f9;
            font-family: sans-serif;
        }

        /* NAVBAR */
        .toolbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 50px;
            background: #1f2937;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
            color: white;
            z-index: 1000;
        }

        .toolbar button {
            background: #374151;
            border: none;
            color: white;
            padding: 6px 12px;
            margin-left: 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .toolbar button:hover {
            background: #4b5563;
        }

        /* IMAGE */
        .content {
            margin-top: 60px;
            text-align: center;
        }

        img {
            width: 794px;
            /* lebar A4 */
            max-width: 90%;
            height: auto;
            background: white;
            padding: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            .toolbar {
                display: none;
            }

            img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }

            @page {
                size: A4;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <!-- TOOLBAR -->
    <div class="toolbar">
        <div id="judulArtikel">Preview</div>
        <div>
            <button onclick="downloadImage()">Download</button>
            <button onclick="window.print()">Print</button>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <img id="previewImg">
    </div>

    <script>
        const params = new URLSearchParams(window.location.search);
        const img = params.get('img');
        const nama = params.get('nama');
        const type = params.get('type');

        document.getElementById('previewImg').src = img;

        // set judul toolbar
        document.getElementById('judulArtikel').innerText = nama || 'Preview';

        // set title tab
        let titleText = '';

        if (type === 'foto') {
            titleText = 'Preview Foto';
        } else if (type === 'spik') {
            titleText = 'Preview Spik';
        } else {
            titleText = 'Preview';
        }

        document.title = titleText;
    </script>

</body>

</html>
