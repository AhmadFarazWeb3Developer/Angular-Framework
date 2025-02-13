import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css',
})
export class AppComponent {
  title = 'My First Angular App';

  constructor() {
    console.log(this.title);
  }

  // Life Cycle hook like useEffect in react
  ngOnInit() {
    console.log('ng init called');
    // this.changeTitle();
  }

  changeTitle() {
    this.title = 'My First Angular App Changed';
  }
}
