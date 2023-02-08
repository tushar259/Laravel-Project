<template>

    <div style="width:100%;">
        <div class="form-horizontal" style="width:30%;margin-left:auto;margin-right:auto;">
            <fieldset>
                <div id="legend">
                    <legend class="">Register</legend>
                </div>

                <div class="control-group">
                    <label class="control-label"  for="username">Name</label>
                    <div class="controls">
                        <input type="text" v-model="signUpInformation.name" placeholder="name" class="form-control">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"  for="username">Email</label>
                    <div class="controls">
                        <input type="email" v-model="signUpInformation.email" placeholder="email" class="form-control">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"  for="username">Password (minimum 3 characters)</label>
                    <div class="controls">
                        <input type="password" v-model="signUpInformation.password" placeholder="password" class="form-control">
                    </div>
                </div>
                <span>{{registrationConfirmation}}</span>
                <div style="height:20px;"></div>
                <div class="control-group">
                <!-- Button -->
                    <div class="controls">
                        <button class="btn btn-success" v-on:click="signUpClicked()" :disabled="isDisabled">Sign up</button>
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
            signUpInformation:{
                'name': '',
                'email': '',
                'password': ''
            },
            registrationConfirmation: '',
            isDisabled: false
        }

    },

    mounted(){
        $("#logout").hide();
        this.getUserData();
    },

    methods:{
        signUpClicked(){
            this.registrationConfirmation = '';
            this.isDisabled = true;
            if(this.signUpInformation.name !='' && this.signUpInformation.email !='' && this.signUpInformation.password !=''){
                
                axios.post('/api/registration', this.signUpInformation).then((response) => {
                    console.log(response.data.data);
                    this.registrationConfirmation = response.data.data;
                    this.signUpInformation.name = '';
                    this.signUpInformation.email = '';
                    this.signUpInformation.password = '';
                    
                    this.isDisabled = false;
                }).catch((error) => {
                    this.isDisabled = false;
                    console.log(error.response.data.errors);
                    this.registrationConfirmation = "Something went wrong!";
                });
                
                
            }
            else{
                this.isDisabled = false;
                this.registrationConfirmation = "Something went wrong!";
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



