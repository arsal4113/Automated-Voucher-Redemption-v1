<template>
    <div class="vue-tempalte">
        <form>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control form-control-lg" />
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control form-control-lg" />
            </div>

            <button type="submit" class="btn btn-dark btn-lg btn-block">Sign In</button>
            <button type="submit" class="btn btn-dark btn-lg btn-block">Register</button>

            <p class="forgot-password text-right mt-2 mb-4">
                <router-link to="login">Forgot password ?</router-link>
            </p>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {}
    }
}
</script>
