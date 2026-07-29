<style>
#ceo-message-container .banner {
    min-height: 290px;
}
#ceo-message-container .banner .container {
    z-index: 2;
}
#ceo-message-container .banner .bg-left {
    bottom: 0;
    left: 0;
    width: 100px;
    height: 130px;
}
#ceo-message-container .banner .bg-right {
    right: 0;
    top: 0;
    width: 100px;
    height: 130px;
    -webkit-transform: scale(-1, 1);
    -moz-transform: scale(-1, 1);
    -ms-transform: scale(-1, 1);
    transform: scale(-1, 1);
}
#ceo-message-container .banner:after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    background: #fff;
    -webkit-filter: opacity(.5);
    filter: opacity(.5);
}
#ceo-message-container .banner-divider {
    padding: 0 60px;
    margin: 25px auto 40px;
}
#ceo-message-container .divider-line {
    border: 0;
    border-top: 1px solid #cdd8eb;
    margin: 0;
}
#ceo-message-container .ceo-message-content {
    padding: 0 0 80px;
}
#ceo-message-container .message-body {
    max-width: 920px;
    margin: 0 auto;
}
#ceo-message-container .main-heading {
    font-family: 'Exo 2', sans-serif;
    color: #23529e;
    font-weight: 700;
    font-size: 32px;
    line-height: 1.35;
    margin-bottom: 30px;
}
#ceo-message-container .message-body p {
    color: #6b778c;
    font-size: 15.5px;
    line-height: 1.75;
    margin-bottom: 22px;
    font-family: 'DM Sans', sans-serif;
}
#ceo-message-container .message-body p strong {
    color: #344054;
    font-weight: 700;
}
#ceo-message-container .ceo-signature-block {
    margin-top: 45px;
    display: inline-block;
}
#ceo-message-container .ceo-portrait {
    width: 165px;
    height: 165px;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 16px;
    box-shadow: 0 8px 24px rgba(35, 82, 158, 0.1);
    background-color: #f4f6f9;
}
#ceo-message-container .ceo-portrait img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
}
#ceo-message-container .ceo-name {
    font-family: 'Exo 2', sans-serif;
    color: #23529e;
    font-weight: 700;
    font-size: 19px;
    margin: 0 0 2px;
    line-height: 1.3;
}
#ceo-message-container .ceo-title {
    font-family: 'Exo 2', sans-serif;
    color: #23529e;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.3;
}

@media (max-width: 767px) {
    #ceo-message-container .banner {
        min-height: 185px;
        background-position: 26% center !important;
        position: relative;
    }
    #ceo-message-container .banner .bg-left,
    #ceo-message-container .banner .bg-right {
        display: none;
    }
    #ceo-message-container .banner-divider {
        padding: 0 15px;
        margin: 15px auto 25px;
    }
    #ceo-message-container .main-heading {
        font-size: 24px;
        margin-bottom: 20px;
    }
    #ceo-message-container .message-body p {
        font-size: 14.5px;
        line-height: 1.65;
        margin-bottom: 18px;
    }
    #ceo-message-container .ceo-portrait {
        width: 140px;
        height: 140px;
    }
}
</style>
