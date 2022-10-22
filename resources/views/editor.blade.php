<!-- wp:paragraph -->
<p>Hello Artisans, today we'll discuss about SPA (single page application) CRUD with Laravel &amp; VueJs. <strong>VueJs</strong> is one of the most popular frontend framework nowadays. It's a very small framework with a massive performance. For more you can check <a href="https://vuejs.org/">here</a> So, no more talk, let's see how we can easily crate a simple SPA CRUD application using Laravel &amp; VueJs Application.</p>
<!-- /wp:paragraph -->
<p><strong>Note:</strong>&nbsp;Tested on<strong>&nbsp;Laravel 9.11</strong></p>

<!-- wp:list {"ordered":true} -->
<ol><li><a href="#step1">Install and Configure Vue and it's Dependency</a></li><li><a href="#step2">Create and Setup Controller</a></li><li><a href="#step3">Create and Setup Component</a></li><li><a href="#step4">Define Routes </a></li><li><a href="#step5">Setup blade File</a></li><li><a href="#step6">Output</a></li></ol>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>First of all, we'll install the <strong>npm</strong> through the below command</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now, we'll install the <strong>laravel-vue-pagination</strong> package. It's quite easy to use pagination in our list. Fire the below command to install it.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now fire the below command to install the <strong>vue-template-complier</strong> and <strong>vue-loader</strong>. So that our mixin and webpack can recognize the <strong>.vue</strong> file. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now we'll install the <strong>sweetalert2</strong>. So that we can notify the user through toastr notification.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now we installed all the necessary packages. Now we need to setup our <strong>app.js</strong> file. So, open the file and replace it with below codes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now we need to configure <strong>webpack.mix.js</strong>, so that we can mix our js and css file. So, open the file and replace it with below codes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>And finally run the below command to watch your developments.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>And that's it. We're done with our <strong>vuejs</strong> setup.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>First of all, create a controller so that we can write our logics or query to show the result. So, fire the below commands in the terminal.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>It'll create a controller under <strong>app\Http\Controllers</strong> called <strong>UserController.php</strong>. Open the file and replace with below codes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now we need to create a <strong>vue</strong> component where we'll fetch our user and perform read/write operation. So, create a file under <strong>resources/js/components</strong> named <strong>users.vue</strong> and replace with following codes.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Now we need put the below routes in <strong>web.php</strong>. Replace it with below codes.</p>
<!-- /wp:paragraph -->


<!-- wp:paragraph -->
<p>Now we'll modify the default blade file named <strong>welcome.blade.php</strong> which comes with Laravel by default.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>And finally we're ready with our setup. It's time to check our output. Now go to <a rel="noreferrer noopener" href="http://127.0.0.1:8000/users" target="_blank">http://127.0.0.1:8000/users</a>, If everything goes well you'll find a below output.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<p>That's it for today. Hope you'll enjoy through this tutorial. You can also also download this tutorial from <strong><a href="https://github.com/shoutsdev/laravel-livewire-crud" target="_blank" rel="noreferrer noopener">GitHub</a></strong>. Thanks for reading :)</p>
<!-- /wp:html -->
