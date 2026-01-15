<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Deteksi Inkonsistensi Kebutuhan Boilerplate</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">

    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <!-- Start Logo -->
                <div class="logo">
                    <a href="#"><img src="{{ asset('img/logoanalysthelper.png') }}" alt="#"></a>
                </div>
                <a href="/" class="logo d-flex align-items-center me-auto"></a>
                <!-- End Logo -->

                <!-- bUTANG RESET -->
                <button class="btn-reset ms-2" id="resetTable"><span class="icon"> ⭮</span> Reset</button>
                <!-- Tombol Generate -->
                <form id="sentenceForm" method="post">
                    @csrf
                    <button class="btn-generate" type="button" id="generateBtn">
                        <span class="icon">✨</span> Generate
                    </button>
            </div>
        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section light-background">

            <div class="container-fluid border p-4">

                <!-- Div buat nambah kalimat manual dan upload-->
                <div class="mt-4 d-flex align-items-center">
                    <input type="text" id="newRequirement" placeholder="add new requirement"
                        class="border p-2 flex-grow-1">
                    <button type="button" class="btn-tambah ms-2" id="addRequirement">Add</button>
                    <label class="btn-upload ms-2">
                        Choose File
                        <input type="file" id="fileInput" accept=".txt, .docx" hidden>
                    </label>
                </div>
                <!-- Simpen sbg string -->
                <input type="hidden" id="sentenceField" name="sentence">
                </form>

                <h2 class="text-center font-bold mt-4">List of Software Requirements (Boilerplate)</h2><br>

                <!-- INPUT SEARCH -->
                <div class="parent-container" style="margin-right:10%">
                    <div class="input-container">
                        <input type="text" id="searchInput" placeholder="Type something...">
                        <span class="clear-btn" id="clearBtn">&times;</span>
                        <button class="search-btn" id="searchButton">Search</button>
                    </div>
                </div>
                <p id="noResultsMessage" style="color: red; display: none;">Tidak ada hasil yang ditemukan.</p>

                <!-- Tabel -->
                <div class="table-container">
                    <table id="requirementTable">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center; vertical-align: middle;">No</th>
                                <th style="width: 70%; text-align: center; vertical-align: middle;">Requirement
                                    Sentences</th>
                                <th style="width: 15%; text-align: center; vertical-align: middle;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <br><br>

                <!-- Div nampilin reslt reasoningdari deteksi inkonsistensi -->
                <hr class="divider">
                <h2 class="text-center font-bold mt-6">Inconsistency Detection Results</h2>
                <div class="border p-4 mt-2 h-32">
                    <pre id="resultContainer"></pre>
                </div>
            </div>

        </section><!-- End Hero Section -->
    </main>

    <!-- FOOTER -->
    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Tentang Kami</span>
                    </a>
                    <div class="footer-contact">
                        <p>Analyst Helper merupakan website yang dapat membantu para analis untuk
                            mendeteksi adanya inkonsistensi dari daftar spesifikasi kebutuhan sistem yang hendak
                            dibangun. Spesifikasi kebutuhan ini haruslah dalam bentuk Boilerplate dan bahasa inggris
                            sebelum dimasukkan ke dalam sistem untuk diperiksa.</p>
                        <p>Malang, Universitas Brawijaya</p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links ms-auto">
                    <h4>Laporkan Bug</h4>
                    <p>Email: audyva.alifia26@gmail.com</p>
                    <p>Whatsapp: 081232111390</p>
                </div>

                <div class="col-lg-2 col-md-3 footer-links ms-auto">
                    <h4>Sosial Media</h4>
                    <div class="social-links">
                        <a href="https://www.facebook.com/audyva.i.alifia"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/irefilev/"><i class="bi bi-instagram"></i></a>
                        <a href="https://twitter.com/cichiokoci"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://github.com/audyvaalifia"><i class="bi bi-github"></i></a>
                        <a href="https://www.linkedin.com/in/audyva-alifia/"><i class="bi bi-linkedin"></i></a>
                        <a href="https://id.pinterest.com/cichiokoci/"><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tulisan copyright tesis -->
        <div class="container copyright text-center mt-4">
            <p>© Copyright 2025 Tesis | All Rights Reserved</p>
            <div class="credits">
                Analyzed by <a href="https://www.analysthelper.com" target="_blank">Audyva Alifia</a>
                Designed by <a href="https://www.analysthelper.com" target="_blank">Audyva Alifia</a>
                Programmed by <a href="https://www.analysthelper.com" target="_blank">Audyva Alifia</a>
                Tested by <a href="https://www.analysthelper.com" target="_blank">Audyva Alifia</a>
                Maintained by <a href="https://www.analysthelper.com" target="_blank">Audyva Alifia</a>
            </div>
        </div>

    </footer> <!-- END FOOTER -->

    <style>
    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .logo img {
        width: auto;
        height: 80px !important;
        max-height: none !important;
        object-fit: contain;
    }

    .btn-tambah {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 255, 0.2);
    }

    .btn-tambah:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 8px rgba(0, 0, 255, 0.3);
        transform: scale(1.05);
    }

    .btn-upload {
        background-color: transparent;
        color: #007bff;
        border: 2px solid #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-upload:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    .btn-generate {
        background: linear-gradient(to right, #6a11cb, #2575fc);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 18px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 255, 0.3);
    }

    .btn-generate:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(0, 0, 255, 0.4);
    }

    .btn-generate .icon {
        font-size: 20px;
    }

    .btn-reset {
        background-color: red;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 18px;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);
        margin-right: 20px;
    }

    .btn-reset:hover {
        background-color: darkred;
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(255, 0, 0, 0.4);
    }

    .btn-delete {
        background-color: red;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);
    }

    .btn-delete:hover {
        background-color: darkred;
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(255, 0, 0, 0.4);
    }

    .btn-edit {
        background-color: orange;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);
    }

    .btn-edit:hover {
        background-color: darkred;
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(255, 0, 0, 0.4);
    }

    .divider {
        border: 0;
        border-top: 10px solid #007bff;
        margin: 20px 0;
    }


    .social-links {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        justify-content: center;
        max-width: 250px;
        margin: auto;
    }

    .social-links a {
        text-align: center;
        font-size: 24px;
    }

    .table-container {
        width: 80%;
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ccc;
        margin: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    thead {
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background: #f8f8f8;
    }
    </style>

    <script>
    // JS buat masukin kalimat req
    $(document).ready(function() {
        let count = 1;
        let sentences = [];

        function addSentenceToTable(text) {
            text = text.trim();
            if (text !== '') {
                sentences.push(text);
                updateSentenceField();

                let newRow = `<tr>
                <td>${count}</td>
                <td class="requirement-text">${text}</td>
                <td style="text-align: center;">
                    <button class="btn btn-warning btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-success btn-save d-none">Save</button>
                    <button class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`;
                $('#requirementTable tbody').append(newRow);
                count++;
            }
        }

        // Tombol tambah buat masukin req manual
        $('#addRequirement').click(function() {
            let text = $('#newRequirement').val().trim();
            if (text !== '') {
                addSentenceToTable(text);
                $('#newRequirement').val('');
            }
        });

        // Edit baris
        $(document).on('click', '.btn-edit', function() {
            let row = $(this).closest('tr');
            let textCell = row.find('.requirement-text');
            let currentText = textCell.text().trim();
            let inputElement = $("<input>", {
                type: "text",
                class: "form-control edit-input"
            }).val(currentText);
            textCell.empty().append(inputElement);
            row.find('.btn-edit').addClass('d-none');
            row.find('.btn-save').removeClass('d-none');
        });

        // CHECKPOINT
        // CHECKPOINT

        // Save seteah edit baris
        $(document).on('click', '.btn-save', function() {
            let row = $(this).closest('tr');
            let newText = row.find('.edit-input').val().trim();
            if (newText !== '') {
                let index = row.index();
                sentences[index] = newText;
                updateSentenceField();
                row.find('.requirement-text').text(newText);
                row.find('.btn-edit').removeClass('d-none');
                row.find('.btn-save').addClass('d-none');
            }
        });

        // Hapus baris
        $(document).on('click', '.btn-delete', function() {
            let row = $(this).closest('tr');
            let index = row.index();
            sentences.splice(index, 1);
            updateSentenceField();
            row.remove();
            count = 1;
            $('#requirementTable tbody tr').each(function() {
                $(this).find('td:first').text(count);
                count++;
            });
        });

        // Simpan isian tabel ke var 
        function updateSentenceField() {
            $('#sentenceField').val(sentences.join(" | "));
        }

        // Input File Upload
        $("#fileInput").on("change", function(event) {
            let file = event.target.files[0];
            if (!file) return;
            let reader = new FileReader();
            let fileType = file.name.split('.').pop().toLowerCase();
            if (fileType === "txt") {
                reader.onload = function(e) {
                    processText(e.target.result);
                };
                reader.readAsText(file);
            } else if (fileType === "docx") {
                reader.onload = function(e) {
                    window.mammoth.extractRawText({
                            arrayBuffer: e.target.result
                        })
                        .then(result => processText(result.value))
                        .catch(err => console.error("Error reading DOCX file:", err));
                };
                reader.readAsArrayBuffer(file);
            } else {
                alert("Format tidak didukung! Pilih file .txt atau .docx.");
            }
        });

        // Pisah kalimat
        function processText(text) {
            let splitSentences = text.split(
                /\n|\r|(?<=\.)\s|(?<=\!)\s|(?<=\?)\s|(?<=\d\.)\s|(?<=\d\))\s|(?<=\d\s-\s)|(?<=•)\s|(?<=-)\s|(?<=\*)\s/
            );
            splitSentences.forEach(sentence => {
                addSentenceToTable(sentence);
            });
        }
    });

    $(document).ready(function() {
        let count = 1;
        let sentences = []; // Menyimpan kalimat dalam satu variabel string

        // Fungsi menambah kalimat ke tabel dan menyimpan dalam sentenceField
        $('#addRequirement').click(function() {
            let text = $('#newRequirement').val().trim();
            if (text !== '') {
                sentences.push(text);
                updateSentenceField();

                let newRow = `<tr>
                    <td>${count}</td>
                    <td class="requirement-text">${text}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btn btn-warning btn-edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-success btn-save d-none">Save</button>
                        <button class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>`;
                $('#requirementTable tbody').append(newRow);
                $('#newRequirement').val('');
                count++;
            }
        });



        // Fungsi menyimpan perubahan edit kalimat
        $(document).on('click', '.btn-save', function() {
            let row = $(this).closest('tr');
            let newText = row.find('.edit-input').val().trim();
            if (newText !== '') {
                let index = row.index(); // Ambil indeks baris untuk update di sentences
                sentences[index] = newText;
                updateSentenceField();

                row.find('.requirement-text').text(newText);
                row.find('.btn-edit').removeClass('d-none');
                row.find('.btn-save').addClass('d-none');
            }
        });

        // Fungsi hapus baris dan update sentenceField
        $(document).on('click', '.btn-delete', function() {
            let row = $(this).closest('tr');
            let index = row.index(); // Ambil indeks baris yang dihapus
            sentences.splice(index, 1); // Hapus dari sentences array
            updateSentenceField();

            row.remove();
            count = 1;
            $('#requirementTable tbody tr').each(function() {
                $(this).find('td:first').text(count);
                count++;
            });
        });

        // Fungsi update nilai sentenceField (gabungan semua kalimat jadi string)
        function updateSentenceField() {
            $('#sentenceField').val(sentences.join(" | ")); // Gabungkan jadi string
        }
    });
    </script>
    <!-- UNCOMM APABILA MAU COCOKIN KE KALIMAT RAW -->
    <!-- <script>
    $.ajax({
    url: "{{ route('normalisasi.nlp') }}",
    type: "POST",
    data: {
        _token: "{{ csrf_token() }}",
        sentence: sentences
    },
    beforeSend: function () {
        $('#resultContainer').html('<p>Normalisasi sedang diproses...</p>');
    },
    success: function (response) {
        $('#resultContainer').html('<p>Normalisasi selesai dan CSV disimpan. Melanjutkan ke reasoning...</p>');

        // Lanjut ke AJAX berikutnya jika perlu
    },
    error: function () {
        $('#resultContainer').html('<p>Error saat normalisasi dan menyimpan CSV.</p>');
    }
});
</script> -->
    <script>
    $(document).ready(function() {
        $('#generateBtn').click(function() {
            let sentences = $('#sentenceField').val();

            $('#resultContainer').html('<p>Tunggu sebentar ya...</p>');


            // Pertama: Langsung jalankan normalisasi dan simpan CSV di controller-nya
            $.ajax({
                url: "{{ route('normalisasi.nlp') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sentence: sentences
                },
                success: function(response) {
                    $('#resultContainer').html(
                        '<p>Normalisasi selesai, memproses ontologi...</p>');

                    setTimeout(function() {
                        resultContainer.html('<p>Memuat HermiT Reasoner...</p>');
                    }, 3000);

                    setTimeout(function() {
                        resultContainer.html('<p>Mendeteksi konflik...</p>');
                    }, 3000);

                    // Kedua: Jalankan reasoning/NLP setelah normalisasi selesai
                    $.ajax({
                        url: "{{ route('process.nlp') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            sentence: sentences
                        },
                        success: function(response) {
                            $('#resultContainer').html(
                                '<p>Ontologi selesai dibangun...</p>');
                            $('#resultContainer').html(response);
                        },
                        error: function() {
                            $('#resultContainer').html(
                                '<p>Error dalam proses reasoning.</p>');
                        }
                    });
                },
                error: function() {
                    $('#resultContainer').html(
                        '<p>Masukkan setidaknya satu kalimat sebelum memeriksa inkonsistensinya!</p>'
                    );
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $("#searchButton").click(function() {
            let searchText = $("#searchInput").val().toLowerCase().trim();
            let found = false;

            $("#requirementTable tbody tr").each(function() {
                let rowText = $(this).find("td:nth-child(2)").text().toLowerCase();

                if (rowText.includes(searchText)) {
                    $(this).show();
                    found = true;
                } else {
                    $(this).hide();
                }
            });

            if (!found) {
                $("#noResultsMessage").show();
            } else {
                $("#noResultsMessage").hide();
            }
        });

        $("#clearBtn").click(function() {
            $("#searchInput").val("");
            $("#requirementTable tbody tr").show();
            $("#noResultsMessage").hide();
        });
    });
    </script>

    <style>
    .parent-container {
        display: flex;
        justify-content: flex-end;
        /* Menggeser ke kanan */
        padding: 20px;
    }

    .input-container {
        position: relative;
        display: flex;
        align-items: center;
        width: 300px;
    }

    input {
        flex: 1;
        padding: 8px 30px 8px 10px;
        /* Ruang untuk ikon X */
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px 0 0 5px;
        outline: none;
    }

    .clear-btn {
        position: absolute;
        right: 90px;
        /* Menyesuaikan dengan tombol Cari */
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: gray;
        display: none;
    }

    .search-btn {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        font-size: 16px;
    }

    .search-btn:hover {
        background-color: #0056b3;
    }
    </style>
    <script>
    const inputField = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearBtn');
    const searchButton = document.getElementById('searchBtn');

    // Tampilkan tombol X saat ada teks
    inputField.addEventListener('input', function() {
        clearButton.style.display = this.value ? 'block' : 'none';
    });

    // Hapus teks saat tombol X ditekan
    clearButton.addEventListener('click', function() {
        inputField.value = '';
        clearButton.style.display = 'none';
        inputField.focus();
    });

    // Contoh fungsi pencarian
    searchButton.addEventListener('click', function() {
        alert("Mencari: " + inputField.value);
    });
    </script>
    <script>
    document.getElementById("resetTable").addEventListener("click", function() {
        location.reload();
    });
    </script>


</body>

</html>