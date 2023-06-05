<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .heading {
        width: 90%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        margin: 20px auto;
    }

    .heading h1 {
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
        font-size: 50px;
        color: #000;
        margin-bottom: 25px;
        position: relative;
    }

    .heading h1::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 4px;
        display: block;
        margin: 0 auto;
        background-color: #4caf50;
    }

    .heading p {
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        color: #666;
        margin-bottom: 10px;
    }

    .container {
        width: 90%;
        margin: 0 auto;
        padding: 10px 20px;
    }

    .about {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .about-image {
        flex: 1;
        overflow: hidden;
        margin-right: 40px;
    }

    .about-image img {
        max-width: 100%;
        height: auto;
        display: block;
        transition: 0.5s ease;
    }

    .about-image:hover img {
        transform: scale(1.2);
    }

    .about-content {
        flex: 1;
    }

    .about-content h2 {
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
        font-size: 23px;
        margin-bottom: 20px;
        color: #333;
    }

    .about-content p {
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        color: #666;
    }

    .about-content .read-more {
        font-family: 'Roboto', sans-serif;
        display: inline-block;
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        font-size: 19px;
        text-decoration: none;
        border-radius: 25px;
        margin-top: 15px;
        transition: 0.3s ease;
    }

    .about-content .read-more:hover {
        background-color: #3e8e41;
    }

    @media screen and (max-width: 768px) {
        .heading {
            padding: 0px 20px;
        }

        .heading h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 600;
            font-size: 36px;
        }

        .heading p {
            font-family: 'Roboto', sans-serif;
            font-size: 17px;
            margin-bottom: 0px;
        }

        .container {
            padding: 0px;
        }

        .about {
            padding: 20px;
            flex-direction: column;
        }

        .about-image {
            margin-right: 0px;
            margin-bottom: 20px;
        }

        .about-content p {
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            font-size: 16px;
        }

        .about-content .read-more {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
        }
    }
</style>

<div class="heading">
    <h1>About Us</h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus ducimus tempore harum, autem nisi doloribus illo. Atque dolores.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates provident eos distinctio possimus officia expedita vitae.
    </p>
</div>
<div class="container">
    <section class="about">
        <div class="about-image">
            <img src="https://i.pinimg.com/564x/4f/46/e6/4f46e6999c62f9bd0d643ddb7480c39c.jpg" alt="">
        </div>
        <div class="about-content">
            <h2>Lorem Ipsum Dolor</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, deserunt unde. Pariatur laborum quibusdam quidem quae magnam maiores vero quas repudiandae magni quia numquam, temporibus sed accusamus laudantium ad omnis?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque ullam vero enim est odio facere asperiores cupiditate commodi similique consectetur? Ipsa praesentium esse quo cumque neque voluptate incidunt provident nisi!
            </p>
            <a href="#" class="read-more">Read More</a>
        </div>
    </section>
</div>