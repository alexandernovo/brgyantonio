<style>
    body {
        background-image: url('{{ asset('assets/images/background.png') }}');
        background-size: cover;
        background-position: center;
    }

    .banner {
        background:
            linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
            url('{{ asset('assets/images/bg.jpg') }}');

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .main-title {
        font-size: 65px;
        letter-spacing: 1px;
    }

    .sub-title {
        font-size: 45px;
        font-weight: 400;
    }

    .user-card {
        position: relative;
        background: #1A212B;
        border: 5px solid white;
        border-radius: 18px;
        height: 320px;
        max-width: 320px;
        padding: 120px 20px 25px;
        transition: 0.3s ease;
        cursor: pointer;
    }

    .user-card:hover {
        transform: translateY(-8px) scale(1.02);
    }

    .user-image-wrapper {
        position: absolute;
        top: -85px;
        left: 50%;
        transform: translateX(-50%);

        width: 220px;
        height: 220px;
        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;

        background: white;
        border: 8px solid #d9d9d9;

        overflow: hidden;

        box-shadow: 0 0 0 10px rgba(255, 255, 255, 0.15);
    }

    .user-image-wrapper::before {
        content: '';

        position: absolute;
        inset: -18px;

        border-radius: 50%;
        border: 10px solid rgba(255, 255, 255, 0.9);

        border-top-color: transparent;
        border-bottom-color: transparent;

        transform: rotate(15deg);
    }

    .user-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 15px;
    }

    .user-role-box {
        margin-top: 60px;

        border: 3px solid white;
        border-radius: 12px;

        padding: 15px 8px;

        color: white;
        text-align: center;

        font-size: 23px;
        font-weight: 500;
        letter-spacing: 1px;

        background: rgba(255, 255, 255, 0.02);
    }

    @media (max-width: 1400px) {

        .main-title {
            font-size: 52px;
        }

        .sub-title {
            font-size: 36px;
        }

        .user-role-box {
            font-size: 28px;
        }

    }

    @media (max-width: 991px) {

        .banner {
            height: auto !important;
            padding-top: 80px;
            padding-bottom: 80px;
        }

        .main-title {
            font-size: 38px;
        }

        .sub-title {
            font-size: 28px;
        }

        .user-card {
            margin-top: 100px;
        }

    }

    @media (max-width: 576px) {

        .main-title {
            font-size: 30px;
        }

        .sub-title {
            font-size: 24px;
        }

        .user-card {
            max-width: 100%;
        }

        .user-role-box {
            font-size: 24px;
        }

    }
</style>
