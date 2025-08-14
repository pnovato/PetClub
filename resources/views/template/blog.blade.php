@extends ('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="whole-wrap">
		<div class="container box_1170">
			<div class="section-top-border">
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{ asset('img/blog/single_blog_1.png') }}" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Google inks pact for new 35-storey office</h2>
                                </a>
                                <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                    he earth it first without heaven in place seed it second morning saying.</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>

                        <article class="blog_item"> 
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{ asset('img/blog/single_blog_2.png') }}" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>
                            </div>
                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Google inks pact for new 35-storey office</h2>
                                </a>
                                <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                    he earth it first without heaven in place seed it second morning saying.</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>
                        <div class="section-top-border">
				<h3 class="mb-30">Block Quotes</h3>
				<div class="row">
					<div class="col-lg-12">
						<blockquote class="generic-blockquote">
							“Recently, the US Federal government banned online casinos from operating in America by
							making it illegal to
							transfer money to them through any US bank or payment system. As a result of this law, most
							of the popular
							online casino networks such as Party Gaming and PlayTech left the United States. Overnight,
							online casino
							players found themselves being chased by the Federal government. But, after a fortnight, the
							online casino
							industry came up with a solution and new online casinos started taking root. These began to
							operate under a
							different business umbrella, and by doing that, rendered the transfer of money to and from
							them legal. A major
							part of this was enlisting electronic banking systems that would accept this new
							clarification and start doing
							business with me. Listed in this article are the electronic banking”
						</blockquote>
					</div>
				</div>
			</div>
        </div>
</div>
@endsection
