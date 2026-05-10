<style>
    .page-container {
        background-color: #bdc3c7;
        height: calc(100vh - 100px);
        /* padding: 15px; */
        font-family: 'Arial', sans-serif;
    }

    .page-container-print {
        background-color: #bdc3c7;
        min-height: 100vh;
        /* padding: 15px; */
        font-family: 'Arial', sans-serif;
    }

    /* Top Left Dashboard Header */
    .top-header {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
        gap: 15px;
    }

    .top-header .icon-container {
        color: #1b3f2f;
    }

    .top-header h1 {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
        color: #000;
    }

    .top-header p {
        margin: 0;
        font-size: 14px;
        color: #333;
    }

    /* The Modal Card */
    .cert-card {
        background: white;
        width: 100%;
        max-width: 440px;
        margin: 0 auto;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        /* Clips the green header to the border radius */
    }

    /* Green Header Section */
    .card-header-green {
        background-color: #1b3f2f;
        padding: 30px 20px;
        text-align: center;
        position: relative;
    }

    .close-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }

    .logo-img {
        width: 120px;
        height: auto;
        margin-bottom: 10px;
    }

    .card-header-green h2 {
        color: white;
        margin: 0;
        font-size: 26px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    /* Card Content Area */
    .card-content {
        padding: 10px;
    }

    .form-label {
        display: block;
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 15px;
        color: #000;
    }

    /* Dropdown Input Group */
    .input-group-custom {
        display: flex;
        border: 2px solid #1b3f2f;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .input-group-icon {
        background-color: #1b3f2f;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 60px;
    }

    .select-field {
        flex: 1;
        border: none;
        padding: 12px 15px;
        font-size: 16px;
        outline: none;
        cursor: pointer;
        background: white url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e") no-repeat right 15px center/15px;
        appearance: none;
    }

    /* Button */
    .btn-submit {
        width: 100%;
        background-color: #1b3f2f;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-reload-table {
        background-color: #2A3646;
        color: white;
        border: none;
        padding: 5px 20px !important;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-edit-table {
        background-color: #2A3646;
        color: white;
        border: none;
        padding: 5px 20px !important;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        border-radius: 8px;
        border: 1px solid white;
    }

    .btn-add-table {
        background-color: #FFFF;
        color: black;
        border: none;
        border-radius: 8px;
        padding: 5px 20px !important;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
    }

    .dt-length label {
        display: none;
    }

    .btn-submit:hover {
        background-color: #143024;
    }

    .date-filter-box .input-group-text {
        background: #1A212B;
        color: #fff;
        border: 1px solid #1A212B;
        font-weight: 600;
    }

    .date-filter-box .form-control {}

    .date-filter-box .form-control::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

    .alpha-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        border: none;
        background: #1A412F;
        color: #fff;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .alpha-btn:hover,
    .alpha-btn.active {
        background: #89A598;
    }

    .btn-filter {
        background: #1A212B;
        color: #fff;
        border: none;
        padding: 0 18px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-filter:hover {
        background: #256344;
    }
</style>
