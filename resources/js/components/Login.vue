<template>

    <div style="width:100%;">
        <div class="form-horizontal" style="width:30%;margin-left:auto;margin-right:auto;">
            <fieldset>
                <div id="legend">
                    <legend class="">Login</legend>
                </div>

                <div class="control-group">
                    <label class="control-label"  for="username">Email</label>
                    <div class="controls">
                        <input type="email" v-model="loginInformation.email" placeholder="email" class="form-control">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"  for="username">Password</label>
                    <div class="controls">
                        <input type="password" v-model="loginInformation.password" placeholder="password" class="form-control">
                    </div>
                </div>
                <span>{{loginConfirmation}}</span>
                <div style="height:20px;"></div>
                <div class="control-group">
                <!-- Button -->
                    <div class="controls">
                        <button class="btn btn-success" v-on:click="loginClicked()" :disabled="isDisabled">Login</button>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>


</template>

<script>
export default{
    data(){
        return{
            loginInformation:{
                'email': '',
                'password': ''
            },
            loginConfirmation: '',
            isDisabled: false
        }

    },

    mounted(){
        $("#logout").hide();
        this.getUserData();
    },

    methods:{
        loginClicked(){
            this.loginConfirmation = "";
            this.isDisabled = true;
            if(this.loginInformation.email !='' && this.loginInformation.password !=''){
                
                axios.post('/api/login', this.loginInformation).then((response) => {
                    localStorage.setItem('accessToken', response.data.data);
                    this.$router.push('/');
                    this.isDisabled = false;
                }).catch((error) => {
                    this.isDisabled = false;
                    console.log(error.response.data.errors);
                    this.loginConfirmation = "Something went wrong!";
                })
            
                
            }
            else{
                this.isDisabled = false;
                this.loginConfirmation = "Something went wrong!";
            }
        },

        getUserData(){
            axios.get('/api/getUserInfo',{
                headers:{
                    'accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken')
                }
            }).then((response) => {
                
                console.log(response);
                if(response.data.message == "success"){
                    this.$router.push('/');
                }
                else{
                    
                }
            })
            .catch((error) => {
                console.log(error.response.data.errors);
            });
            
        },
    }

}
</script>

