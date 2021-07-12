<template>
    <div class="media simple-post">
        <img class="mr-3" src="img/p1.jpg" alt="Generic placeholder image">
        <div class="media-body">
            <h4 class="mt-0"><a href="blog-post.html">title</a></h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            <ul class="list-inline list-unstyled d-flex post-info">
                <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">Ayat amine</strong> </span></li>
                <li>|</li>
                <li><span><i class="fa fa-calendar"></i> 2 days, 8 hours </span></li>
                <li>|</li>
                <span><i class="fa fa-comment"></i> 2 comments</span>

            </ul>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
